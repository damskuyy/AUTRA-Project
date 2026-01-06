import Image from "next/image";

export default function InformationSection() {
  return (
    <section id="about" className="py-16" 
    style={{ 
      background: 'hsl(var(--brown-medium))',
      marginTop: '-400px',
      paddingTop: '480px',
      borderTopLeftRadius: '200px',
      borderTopRightRadius: '200px',
      zIndex: 4,
    }}>
      <div className="container mx-auto px-6">
        <div className="mb-8">
          <div
            className="inline-block px-6 py-4"
            style={{
              background: 'hsl(var(--yellow-warm))',
              borderRadius: '16px',
              boxShadow: '0 8px 24px rgba(0,0,0,0.18)'
            }}
          >
            <h2 className="text-3xl font-black" style={{ color: 'hsl(var(--brown-dark))' }}>Information</h2>
            <p className="text-xl font-bold" style={{ color: 'hsl(var(--brown-dark))' }}>About Majors</p>
          </div>
        </div>

        <div className="grid md:grid-cols-2 gap-8 items-center">
          <div className="space-y-6 pr-4">
            <p className="text-lg leading-relaxed text-[hsl(var(--cream))]" style={{ maxWidth: '520px' }}>
              Teknik otomasi industri adalah bidang teknik yang berfokus pada perancangan, pengendalian, dan penerapan sistem otomatis untuk mengoptimalkan proses produksi di industri. Bidang ini mengintegrasikan elektronika, kelistrikan, sistem kontrol, pemrograman, sensor, aktuator, PLC, HMI, dan SCADA untuk mengendalikan mesin dan proses secara otomatis.
            </p>
            <p className="text-lg leading-relaxed text-[hsl(var(--cream))]" style={{ maxWidth: '520px' }}>
              Tujuan utama otomasi industri adalah meningkatkan efisiensi, produktivitas, kualitas, keamanan, dan konsistensi proses, serta mengurangi ketergantungan pada tenaga manusia dalam pekerjaan yang berisiko atau berulang.
            </p>
          </div>

          <div className="flex justify-center md:justify-end">
            <div style={{ borderRadius: '12px', overflow: 'hidden', padding: '6px', background: 'linear-gradient(to right, white, hsl(var(--yellow-warm)))', boxShadow: '0 10px 30px rgba(0,0,0,0.25)' }}>
              <Image
                src="/foto-lab.jpeg"
                alt="Foto Laboratorium Otomasi"
                width={360}
                height={240}
                className="w-[320px] h-[200px] md:w-[360px] md:h-[240px] object-cover"
                style={{ borderRadius: '6px' }}
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

