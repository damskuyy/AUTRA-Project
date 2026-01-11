"use client";

import Image from "next/image";
import { useState } from "react";

export default function InformationSection() {
  const [isVideoLoaded, setIsVideoLoaded] = useState(false);

  return (
    <section
      id="about"
      className="py-16"
      style={{
        background: "hsl(var(--brown-medium))",
        marginTop: "-400px",
        paddingTop: "480px",
        borderTopLeftRadius: "200px",
        borderTopRightRadius: "200px",
        zIndex: 4,
      }}
    >
      {/* Decorative background elements */}
      <div
        className="absolute top-10 right-10 w-72 h-72 rounded-full opacity-5"
        style={{ background: "hsl(var(--yellow-warm))", marginTop: "700px", paddingTop: "10rem" }}
      />
      <div
        className="absolute bottom-10 left-10 w-96 h-96 rounded-full opacity-5"
        style={{ background: "hsl(var(--yellow-warm))", marginTop: "400px", paddingTop: "10rem"}}
      />
      
      <div className="container mx-auto px-6 relative z-10">
        {/* Header */}
        <div className="text-center mb-12">
          <div
            className="inline-block rounded-full px-12 py-4 shadow-2xl staff-header"
            style={{
              background: "hsl(var(--yellow-warm))",
              boxShadow: "0 12px 32px rgba(0,0,0,0.25)",
            }}
          >
            <h2
              className="text-3xl md:text-4xl font-black tracking-tight"
              style={{ color: "hsl(var(--brown-dark))" }}
            >
              Information About Majors
            </h2>
          </div>
          <p
            className="mt-6 text-lg max-w-2xl mx-auto"
            style={{ color: "hsl(var(--cream))" }}
          >
            Menampilkan Informasi Mengenai Jurusan Teknik Otomasi Industri
          </p>
        </div>

        {/* Information Content */}
        <div className="grid md:grid-cols-2 gap-8 items-center mb-20">
          <div className="space-y-6 pr-4">
            <p
              className="text-lg leading-relaxed text-[hsl(var(--cream))]"
              style={{ maxWidth: "520px" }}
            >
              Teknik otomasi industri adalah bidang teknik yang berfokus pada
              perancangan, pengendalian, dan penerapan sistem otomatis untuk
              mengoptimalkan proses produksi di industri. Bidang ini
              mengintegrasikan elektronika, kelistrikan, sistem kontrol,
              pemrograman, sensor, aktuator, PLC, HMI, dan SCADA untuk
              mengendalikan mesin dan proses secara otomatis.
            </p>
            <p
              className="text-lg leading-relaxed text-[hsl(var(--cream))]"
              style={{ maxWidth: "520px" }}
            >
              Tujuan utama otomasi industri adalah meningkatkan efisiensi,
              produktivitas, kualitas, keamanan, dan konsistensi proses, serta
              mengurangi ketergantungan pada tenaga manusia dalam pekerjaan yang
              berisiko atau berulang.
            </p>
          </div>

          <div className="flex justify-center md:justify-end">
            <div
              style={{
                borderRadius: "12px",
                overflow: "hidden",
                padding: "6px",
                background:
                  "linear-gradient(to right, white, hsl(var(--yellow-warm)))",
                boxShadow: "0 10px 30px rgba(0,0,0,0.25)",
              }}
            >
              <Image
                src="/foto-lab.jpeg"
                alt="Foto Laboratorium Otomasi"
                width={450}
                height={320}
                className="w-[400px] h-[280px] md:w-[450px] md:h-[320px] object-cover"
                style={{ borderRadius: "6px" }}
              />
            </div>
          </div>
        </div>

        {/* Video Profile Section */}
        <div className="max-w-5xl mx-auto">
          {/* Video Header */}
          <div className="text-center mb-8">
            <div 
              className="inline-block rounded-full px-10 py-3 shadow-xl"
              style={{ 
                background: 'hsl(var(--yellow-warm))',
                boxShadow: '0 8px 24px rgba(0,0,0,0.2)'
              }}
            >
              <h3 
                className="text-2xl md:text-3xl font-black tracking-tight"
                style={{ color: 'hsl(var(--brown-dark))' }}
              >
                Video Profil Jurusan
              </h3>
            </div>
            <p 
              className="mt-4 text-base max-w-xl mx-auto"
              style={{ color: 'hsl(var(--cream))' }}
            >
              Lihat lebih dekat kehidupan dan fasilitas di Jurusan Teknik Otomasi Industri
            </p>
          </div>

          {/* Video Container */}
          <div 
            className="relative rounded-3xl overflow-hidden shadow-2xl video-container"
            style={{
              background: 'linear-gradient(135deg, rgba(0,0,0,0.3), rgba(0,0,0,0.1))',
              padding: '8px',
            }}
          >
            <div className="relative rounded-2xl overflow-hidden" style={{ paddingBottom: '56.25%' }}>
              {/* Loading Placeholder */}
              {!isVideoLoaded && (
                <div 
                  className="absolute inset-0 flex items-center justify-center"
                  style={{
                    background: 'linear-gradient(135deg, hsl(var(--brown-dark)), hsl(var(--brown-medium)))'
                  }}
                >
                  <div className="text-center">
                    <div 
                      className="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center"
                      style={{ background: 'hsl(var(--yellow-warm))' }}
                    >
                      <svg 
                        width="32" 
                        height="32" 
                        viewBox="0 0 24 24" 
                        fill="hsl(var(--brown-dark))"
                      >
                        <path d="M8 5v14l11-7z"/>
                      </svg>
                    </div>
                    <p style={{ color: 'hsl(var(--cream))' }} className="text-sm">
                      Loading video...
                    </p>
                  </div>
                </div>
              )}

              {/* YouTube Video Embed */}
              <iframe
                className="absolute top-0 left-0 w-full h-full"
                src="https://www.youtube.com/embed/Cb58-__g4O8?si=9TGIC0fKJ4S8pM0n"
                title="Video Profil Jurusan Teknik Otomasi Industri"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
                onLoad={() => setIsVideoLoaded(true)}
                style={{
                  border: 'none',
                  borderRadius: '12px'
                }}
              />
            </div>

            {/* Gradient Border Effect */}
            <div 
              className="absolute inset-0 rounded-3xl pointer-events-none"
              style={{
                background: 'linear-gradient(135deg, hsl(var(--yellow-warm)), hsl(var(--orange-bright)))',
                padding: '2px',
                WebkitMask: 'linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0)',
                WebkitMaskComposite: 'xor',
                maskComposite: 'exclude',
                opacity: 0.6
              }}
            />
          </div>

          {/* Video Caption */}
          {/* <div className="text-center mt-6">
            <p 
              className="text-sm"
              style={{ color: 'hsl(var(--cream))', opacity: 0.8 }}
            >
              📹 Ganti URL video di <code style={{ 
                background: 'rgba(0,0,0,0.3)', 
                padding: '2px 8px', 
                borderRadius: '4px',
                fontFamily: 'monospace'
              }}>src="..."</code> dengan YouTube embed link Anda
            </p>
          </div> */}
        </div>
      </div>
    </section>
  );
}