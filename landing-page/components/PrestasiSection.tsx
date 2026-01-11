"use client";

export default function PrestasiSection() {
  const prestasiList = [
    {
      year: "2024",
      title: "Juara 1 LKS Provinsi Jawa Barat",
      description: "Meraih juara pertama pada Lomba Kompetensi Siswa bidang Industrial Control tingkat Provinsi Jawa Barat",
      location: "Bandung, Jawa Barat"
    },
    {
      year: "2023",
      title: "Juara 2 LKS Nasional",
      description: "Meraih juara kedua pada Lomba Kompetensi Siswa bidang Industrial Control tingkat Nasional",
      location: "Jakarta, Indonesia"
    },
    {
      year: "2024",
      title: "Juara 1 Robotik Competition",
      description: "Meraih juara pertama pada kompetisi robotik tingkat Jawa Barat kategori Industrial Automation",
      location: "Cimahi, Jawa Barat"
    },
    {
      year: "2023",
      title: "Best Innovation Award",
      description: "Penghargaan inovasi terbaik dalam bidang sistem otomasi industri tingkat regional",
      location: "Surabaya, Jawa Timur"
    },
    {
      year: "2024",
      title: "Juara 3 IoT Competition",
      description: "Meraih juara ketiga pada kompetisi Internet of Things untuk aplikasi industri 4.0",
      location: "Semarang, Jawa Tengah"
    },
    {
      year: "2023",
      title: "Excellence Award PLC Programming",
      description: "Penghargaan keunggulan dalam kompetisi pemrograman PLC tingkat nasional",
      location: "Yogyakarta, Indonesia"
    }
  ];

  return (
    <section 
      id="prestasi"
      className="py-20"
      style={{ 
        background: 'linear-gradient(135deg, hsl(var(--brown-medium)) 0%, hsl(var(--brown-dark)) 50%, hsl(var(--brown-medium)) 100%)',
        position: 'relative',
        overflow: 'hidden'
      }}
    >
      {/* Decorative circles */}
      <div 
        className="absolute top-10 right-5 w-48 h-48 rounded-full opacity-5"
        style={{ background: 'hsl(var(--yellow-warm))' }}
      />
      <div 
        className="absolute bottom-10 left-5 w-64 h-64 rounded-full opacity-5"
        style={{ background: 'hsl(var(--orange-bright))' }}
      />

      <div className="container mx-auto px-6 relative z-10">
        {/* Header */}
        <div className="text-center mb-16">
          <div 
            className="inline-block rounded-full px-10 py-4 shadow-2xl prestasi-header"
            style={{ 
              background: 'hsl(var(--yellow-warm))',
              boxShadow: '0 12px 32px rgba(0,0,0,0.25)'
            }}
          >
            <h2 
              className="text-3xl md:text-4xl font-black tracking-tight"
              style={{ color: 'hsl(var(--brown-dark))' }}
            >
              Prestasi Jurusan
            </h2>
          </div>
          <p 
            className="mt-6 text-lg max-w-2xl mx-auto"
            style={{ color: 'hsl(var(--cream))' }}
          >
            Berbagai pencapaian membanggakan yang telah diraih oleh siswa Teknik Otomasi Industri
          </p>
        </div>

        {/* Prestasi Grid */}
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {prestasiList.map((prestasi, index) => (
            <div
              key={index}
              className="prestasi-card group"
              style={{
                animation: `prestasiCardFadeIn 0.6s ease-out ${index * 0.1}s backwards`
              }}
            >
              <div 
                className="relative rounded-3xl overflow-hidden shadow-xl hover-lift-prestasi"
                style={{ 
                  background: 'hsl(var(--orange-bright)) !important',
                  minHeight: '280px',
                  transition: 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)'
                }}
              >
                {/* Year Badge */}
                <div 
                  className="absolute -top-12 left-1/2 transform -translate-x-1/2 z-10"
                  style={{
                    width: '100px',
                    height: '100px'
                  }}
                >
                  <div 
                    className="w-full h-full rounded-full flex items-center justify-center shadow-2xl year-badge"
                    style={{
                      background: 'white',
                      border: '8px solid hsl(var(--orange-bright))'
                    }}
                  >
                    <span 
                      className="text-3xl font-black"
                      style={{ color: 'hsl(var(--brown-dark))' }}
                    >
                      {prestasi.year}
                    </span>
                  </div>
                </div>

                {/* Card Content */}
                <div className="pt-14 pb-6 px-8 text-center flex flex-col justify-between" style={{ minHeight: '280px' }}>
                  <div>
                    <h3 
                      className="text-2xl font-black mb-4 text-white leading-tight"
                    >
                      {prestasi.title}
                    </h3>

                    <p 
                      className="text-base text-white/95 leading-relaxed italic mb-6"
                    >
                      {prestasi.description}
                    </p>
                  </div>

                  {/* Location */}
                  <div className="flex items-center justify-center gap-2 text-white mt-auto">
                    <svg 
                      width="24" 
                      height="24" 
                      viewBox="0 0 24 24" 
                      fill="none" 
                      stroke="currentColor" 
                      strokeWidth="2.5"
                    >
                      <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                      <circle cx="12" cy="10" r="3"/>
                    </svg>
                    <span className="text-base font-bold">
                      {prestasi.location}
                    </span>
                  </div>
                </div>

                {/* Hover Overlay */}
                <div 
                  className="absolute inset-0 bg-gradient-to-br from-white/0 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"
                />
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}