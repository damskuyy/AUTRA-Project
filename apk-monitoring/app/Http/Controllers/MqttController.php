<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class MqttController extends Controller
{
    // Path ke script Python (relatif dari project root)
    private $scriptPath;
    
    // Path untuk menyimpan PID
    private $pidFile;
    
    // Path untuk log
    private $logFile;

    private $pythonPath = 'C:\\Python313\\python.exe';

    public function __construct()
    {
        // Path ke script Python di root project
        $this->scriptPath = base_path('plc/mqtt_reader.py');
        
        // Path untuk menyimpan PID di storage
        $this->pidFile = storage_path('app/mqtt_reader.pid');
        
        // Path untuk log
        $this->logFile = storage_path('logs/mqtt_reader.log');

        $this->pythonPath = 'C:\Python313\python.exe';
    }

    /**
     * Start MQTT Reader Script
     */
    public function start()
    {
        try {
            // Check if already running
            if ($this->isRunning()) {
                return response()->json([
                    'success' => false,
                    'message' => 'MQTT Reader sudah berjalan',
                    'status' => 'running'
                ]);
            }

            // Check if script exists
            if (!file_exists($this->scriptPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File mqtt_reader.py tidak ditemukan',
                    'status' => 'error'
                ]);
            }

            // Use hardcoded Python path
            $pythonCmd = $this->pythonPath;

            if (!$pythonCmd || !file_exists(str_replace('"', '', $pythonCmd))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Python tidak ditemukan di: ' . $pythonCmd,
                    'status' => 'error'
                ]);
            }

            // Build command to run Python script in background
            // Windows
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $command = "start /B {$pythonCmd} \"{$this->scriptPath}\" > \"{$this->logFile}\" 2>&1";
                pclose(popen($command, 'r'));
                
                // Get PID (Windows - more complex, using tasklist)
                sleep(1); // Wait for process to start
                $output = shell_exec("tasklist /FI \"IMAGENAME eq python.exe\" /FO CSV /NH");
                if ($output) {
                    $lines = explode("\n", trim($output));
                    if (count($lines) > 0) {
                        $parts = str_getcsv($lines[0]);
                        if (isset($parts[1])) {
                            $pid = trim($parts[1]);
                            file_put_contents($this->pidFile, $pid);
                        }
                    }
                }
            } 
            // Linux/Mac
            else {
                $command = "nohup {$pythonCmd} \"{$this->scriptPath}\" > \"{$this->logFile}\" 2>&1 & echo $!";
                $pid = shell_exec($command);
                
                if ($pid) {
                    file_put_contents($this->pidFile, trim($pid));
                }
            }

            // Verify process started
            sleep(1);
            if ($this->isRunning()) {
                Log::info('MQTT Reader started successfully');
                
                return response()->json([
                    'success' => true,
                    'message' => 'MQTT Reader berhasil dijalankan',
                    'status' => 'running',
                    'pid' => $this->getPid()
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menjalankan MQTT Reader. Periksa log untuk detail.',
                    'status' => 'error'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Failed to start MQTT Reader: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    /**
     * Stop MQTT Reader Script
     */
    public function stop()
    {
        try {
            if (!$this->isRunning()) {
                return response()->json([
                    'success' => false,
                    'message' => 'MQTT Reader tidak sedang berjalan',
                    'status' => 'stopped'
                ]);
            }

            $pid = $this->getPid();

            if (!$pid) {
                return response()->json([
                    'success' => false,
                    'message' => 'PID tidak ditemukan',
                    'status' => 'error'
                ]);
            }

            // Kill process
            // Windows
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                shell_exec("taskkill /PID {$pid} /F 2>&1");
            } 
            // Linux/Mac
            else {
                shell_exec("kill -9 {$pid} 2>&1");
            }

            // Remove PID file
            if (file_exists($this->pidFile)) {
                unlink($this->pidFile);
            }

            // Verify process stopped
            sleep(1);
            if (!$this->isRunning()) {
                Log::info('MQTT Reader stopped successfully');
                
                return response()->json([
                    'success' => true,
                    'message' => 'MQTT Reader berhasil dihentikan',
                    'status' => 'stopped'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghentikan MQTT Reader',
                    'status' => 'error'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Failed to stop MQTT Reader: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    /**
     * Restart MQTT Reader Script
     */
    public function restart()
    {
        // Stop first
        $this->stop();
        
        // Wait a moment
        sleep(2);
        
        // Start again
        return $this->start();
    }

    /**
     * Get MQTT Reader Status
     */
    public function status()
    {
        $isRunning = $this->isRunning();
        $pid = $this->getPid();

        return response()->json([
            'success' => true,
            'status' => $isRunning ? 'running' : 'stopped',
            'is_running' => $isRunning,
            'pid' => $pid,
            'script_path' => $this->scriptPath,
            'log_file' => $this->logFile
        ]);
    }

    /**
     * Get recent logs
     */
    public function logs(Request $request)
    {
        $lines = $request->get('lines', 50);

        if (!file_exists($this->logFile)) {
            return response()->json([
                'success' => true,
                'logs' => 'No logs available yet.'
            ]);
        }

        // Read last N lines
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows - use PowerShell
            $command = "powershell -command \"Get-Content '{$this->logFile}' -Tail {$lines}\"";
        } else {
            // Linux/Mac - use tail
            $command = "tail -n {$lines} \"{$this->logFile}\"";
        }

        $output = shell_exec($command);

        return response()->json([
            'success' => true,
            'logs' => $output ?: 'Empty log file.'
        ]);
    }

    /**
     * Check if MQTT Reader is running
     */
    private function isRunning()
    {
        $pid = $this->getPid();

        if (!$pid) {
            return false;
        }

        // Check if process exists
        // Windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $output = shell_exec("tasklist /FI \"PID eq {$pid}\" /NH 2>&1");
            return (strpos($output, (string)$pid) !== false);
        } 
        // Linux/Mac
        else {
            $output = shell_exec("ps -p {$pid} 2>&1");
            return (strpos($output, (string)$pid) !== false);
        }
    }

    /**
     * Get PID from file
     */
    private function getPid()
    {
        if (!file_exists($this->pidFile)) {
            return null;
        }

        $pid = trim(file_get_contents($this->pidFile));
        return $pid ?: null;
    }

    /**
     * Detect Python command (python3 or python)
     */
    /**
 * Detect Python command (python3 or python)
 */
private function detectPythonCommand()
    {
        // Try python3 first
        $output = shell_exec('python3 --version 2>&1');
        if ($output && strpos($output, 'Python') !== false) {
            return 'python3';
        }

        // Try python
        $output = shell_exec('python --version 2>&1');
        if ($output && strpos($output, 'Python') !== false) {
            return 'python';
        }

        // Try py (Windows)
        $output = shell_exec('py --version 2>&1');
        if ($output && strpos($output, 'Python') !== false) {
            return 'py';
        }

        // Try common Windows Python paths
        $possiblePaths = [
            'C:\\Python313\\python.exe',
            'C:\\Python312\\python.exe',
            'C:\\Python311\\python.exe',
            'C:\\Python310\\python.exe',
        ];

        // Try user-specific paths
        $username = getenv('USERNAME');
        if ($username) {
            $userPaths = [
                "C:\\Users\\{$username}\\AppData\\Local\\Programs\\Python\\Python313\\python.exe",
                "C:\\Users\\{$username}\\AppData\\Local\\Programs\\Python\\Python312\\python.exe",
                "C:\\Users\\{$username}\\AppData\\Local\\Programs\\Python\\Python311\\python.exe",
            ];
            $possiblePaths = array_merge($possiblePaths, $userPaths);
        }

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                return "\"{$path}\""; // Wrap in quotes for spaces in path
            }
        }

        return null;
    }
}