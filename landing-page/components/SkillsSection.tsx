"use client";

import Image from "next/image";
import { useEffect, useRef, useState } from "react";

export default function SkillsSection() {
  const [visibleCards, setVisibleCards] = useState<number[]>([]);
  const sectionRef = useRef<HTMLElement>(null);

  const skills = [
    {
      name: "Sistem Kendali Elektromekanik",
      description: "Mengoperasikan sistem kendali berbasis elektromekanik dan elektronik untuk otomasi industri",
      image: "/skill/Elektromekanik.png", // Ganti dengan foto relay, kontaktor, atau sistem panel listrik
      gradient: "from-amber-500 to-orange-600"
    },
    {
      name: "Kendali Digital & Mikroprosesor",
      description: "Mengoperasikan sistem kendali digital, mikroprosesor dan elektropneumatik",
      image: "/skill/Mikroprosesor.png", // Ganti dengan foto Arduino, microcontroller, atau breadboard
      gradient: "from-orange-500 to-red-600"
    },
    {
      name: "Sensor & Aktuator",
      description: "Mengoperasikan sistem sensor, transducer, aktuator, dan motor untuk berbagai aplikasi industri",
      image: "/skill/Sensor&Akuator.png", // Ganti dengan foto berbagai sensor atau motor
      gradient: "from-yellow-500 to-amber-600"
    },
    {
      name: "PLC & SCADA",
      description: "Mengoperasikan PLC dan SCADA untuk keperluan otomasi dan monitoring sistem industri",
      image: "/skill/PLC&SCADA.png", // Ganti dengan foto PLC Siemens/Schneider atau layar SCADA
      gradient: "from-orange-600 to-red-700"
    },
    {
      name: "Perakitan Sistem Otomasi",
      description: "Merakit sistem kendali berbasis relai dan elektropneumatik untuk otomasi industri",
      image: "/skill/SistemOtomasi.png", // Ganti dengan foto siswa merakit panel atau sistem pneumatik
      gradient: "from-amber-600 to-orange-700"
    },
    {
      name: "Pemeliharaan Sistem",
      description: "Melaksanakan pemeliharaan sistem kendali elektrik, pneumatic, PLC, dan SCADA",
      image: "/skill/PemeliharaanSistem.png", // Ganti dengan foto maintenance atau troubleshooting
      gradient: "from-yellow-600 to-orange-600"
    }
  ];

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const cards = entry.target.querySelectorAll('.skill-card');
            cards.forEach((card, index) => {
              setTimeout(() => {
                setVisibleCards(prev => [...prev, index]);
              }, index * 150);
            });
          }
        });
      },
      { threshold: 0.1 }
    );

    if (sectionRef.current) {
      observer.observe(sectionRef.current);
    }

    return () => observer.disconnect();
  }, []);

  return (
    <section 
      id="skills"
      ref={sectionRef}
      className="py-20"
      style={{ 
        background: 'linear-gradient(135deg, hsl(var(--brown-medium)) 0%, hsl(var(--brown-dark)) 50%, hsl(var(--brown-medium)) 100%)',
        position: 'relative',
        overflow: 'hidden'
      }}
    >
      {/* Decorative circles */}
      <div 
        className="absolute top-20 right-10 w-64 h-64 rounded-full opacity-5"
        style={{ background: 'hsl(var(--yellow-warm))' }}
      />
      <div 
        className="absolute bottom-20 left-10 w-80 h-80 rounded-full opacity-5"
        style={{ background: 'hsl(var(--orange-bright))' }}
      />

      <div className="container mx-auto px-6 relative z-10">
        {/* Header */}
        <div className="text-center mb-16">
          <div 
            className="inline-block rounded-full px-10 py-4 shadow-2xl skill-header"
            style={{ 
              background: 'hsl(var(--yellow-warm))',
              boxShadow: '0 12px 32px rgba(0,0,0,0.25)'
            }}
          >
            <h2 
              className="text-3xl md:text-4xl font-black tracking-tight"
              style={{ color: 'hsl(var(--brown-dark))' }}
            >
              Skills For Industrial Automation
            </h2>
          </div>
          <p 
            className="mt-6 text-lg max-w-2xl mx-auto"
            style={{ color: 'hsl(var(--cream))' }}
          >
            Kompetensi utama yang dikuasai oleh siswa Teknik Otomasi Industri
          </p>
        </div>

        {/* Skills Grid */}
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {skills.map((skill, index) => (
            <div
              key={index}
              className={`skill-card ${visibleCards.includes(index) ? 'skill-card-visible' : ''}`}
              style={{
                opacity: visibleCards.includes(index) ? 1 : 0,
                transform: visibleCards.includes(index) ? 'translateY(0)' : 'translateY(30px)'
              }}
            >
              <div 
                className="h-full rounded-2xl overflow-hidden shadow-xl hover-lift"
                style={{ 
                  background: 'white',
                  transition: 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)'
                }}
              >
                {/* Image Container */}
                <div className="relative h-56 overflow-hidden group">
                  <div 
                    className={`absolute inset-0 bg-gradient-to-br ${skill.gradient} opacity-10 group-hover:opacity-20 transition-opacity duration-300`}
                  />
                  <Image
                    src={skill.image}
                    alt={skill.name}
                    fill
                    className="object-cover group-hover:scale-110 transition-transform duration-500"
                    onError={(e) => {
                      // Fallback to gradient if image not found
                      const target = e.target as HTMLImageElement;
                      target.style.display = 'none';
                      if (target.parentElement) {
                        // Extract gradient colors from skill.gradient
                        const gradientMatch = skill.gradient.match(/from-(\S+)\s+to-(\S+)/);
                        if (gradientMatch) {
                          const fromColor = gradientMatch[1];
                          const toColor = gradientMatch[2];
                          target.parentElement.style.background = `linear-gradient(135deg, var(--${fromColor}), var(--${toColor}))`;
                        }
                      }
                    }}
                  />
                  
                  {/* Gradient Overlay Bar */}
                  <div 
                    className={`absolute top-0 left-0 right-0 h-2 bg-gradient-to-r ${skill.gradient}`}
                  />
                </div>

                {/* Content */}
                <div className="p-6">
                  <h3 
                    className="text-xl font-bold mb-3 line-clamp-2"
                    style={{ color: 'hsl(var(--brown-dark))' }}
                  >
                    {skill.name}
                  </h3>
                  
                  <p 
                    className="text-sm leading-relaxed text-gray-600 line-clamp-3"
                  >
                    {skill.description}
                  </p>

                  {/* Decorative bottom bar */}
                  <div 
                    className={`mt-4 h-1 rounded-full bg-gradient-to-r ${skill.gradient} skill-bar`}
                    style={{ width: '0%' }}
                  />
                </div>
              </div>
            </div>
          ))}
        </div>

        {/* Bottom decoration */}
        {/* <div className="mt-16 text-center">
          <div className="inline-flex items-center gap-3 px-6 py-3 rounded-full"
            style={{ 
              background: 'rgba(255, 255, 255, 0.1)',
              backdropFilter: 'blur(10px)'
            }}
          >
            <div className="flex gap-1">
              {[0, 1, 2].map((i) => (
                <div
                  key={i}
                  className="w-2 h-2 rounded-full pulse-dot"
                  style={{ 
                    background: 'hsl(var(--yellow-warm))',
                    animationDelay: `${i * 0.2}s`
                  }}
                />
              ))}
            </div>
          </div>
        </div> */}
      </div>
    </section>
  );
}