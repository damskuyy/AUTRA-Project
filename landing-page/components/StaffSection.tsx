"use client";

import { useRef, useEffect, useState } from 'react';
import Image from 'next/image';

export default function StaffSection() {
  const scrollContainerRef = useRef<HTMLDivElement>(null);
  const [isDragging, setIsDragging] = useState(false);
  const [startX, setStartX] = useState(0);
  const [scrollLeft, setScrollLeft] = useState(0);
  const [visibleCards, setVisibleCards] = useState<number[]>([]);

  const staffMembers = [
    { name: "Indra Mustika Rahman Prawiradiredja, S. Pd", role: "Kepala Konsntrasi keahlian TOI", image: "/indra.jfif" },
    { name: "Ishri Rizki Prastiwi Zulhiana, S. Pd", role: "Kepala Bengkel TOI", image: "/ishri.jfif" },
    { name: "Kosimudin, S. Pd", role: "Guru Produktif TOI", image: "/kosimudin.jfif" },
    { name: "Eva Sri Handayani, S. Pd", role: "Guru Produktif TOI", image: "/eva.jfif" },
    { name: "Syahida Muti'ah, S.Pd", role: "Guru Produktif TOI", image: "/syahida.jfif" },
    { name: "Farida Nurhasanah, S. Pd", role: "Guru Produktif TOI", image: "/farida.jfif" },
    { name: "Dika Alfiana", role: "Teknisi TOI", image: "/dika.jfif" },
  ];

  // Animate cards on mount
  useEffect(() => {
    staffMembers.forEach((_, index) => {
      setTimeout(() => {
        setVisibleCards(prev => [...prev, index]);
      }, index * 100);
    });
  }, []);

  const handleMouseDown = (e: React.MouseEvent) => {
    if (!scrollContainerRef.current) return;
    setIsDragging(true);
    setStartX(e.pageX - scrollContainerRef.current.offsetLeft);
    setScrollLeft(scrollContainerRef.current.scrollLeft);
  };

  const handleMouseMove = (e: React.MouseEvent) => {
    if (!isDragging || !scrollContainerRef.current) return;
    e.preventDefault();
    const x = e.pageX - scrollContainerRef.current.offsetLeft;
    const walk = (x - startX) * 2;
    scrollContainerRef.current.scrollLeft = scrollLeft - walk;
  };

  const handleMouseUp = () => {
    setIsDragging(false);
  };

  const handleMouseLeave = () => {
    setIsDragging(false);
  };

  return (
    <section 
      id="tendik" 
      className="py-20 w-full" 
      style={{ 
        background: 'hsl(var(--brown-medium))',
        position: 'relative',
        overflow: 'hidden'
      }}
    >
      {/* Decorative background elements */}
      <div 
        className="absolute top-10 right-10 w-72 h-72 rounded-full opacity-5"
        style={{ background: 'hsl(var(--yellow-warm))' }}
      />
      <div 
        className="absolute bottom-10 left-10 w-96 h-96 rounded-full opacity-5"
        style={{ background: 'hsl(var(--orange-bright))' }}
      />

      <div className="container mx-auto px-6 relative z-10">
        {/* Header */}
        <div className="text-center mb-12">
          <div 
            className="inline-block rounded-full px-12 py-4 shadow-2xl staff-header"
            style={{ 
              background: 'hsl(var(--yellow-warm))',
              boxShadow: '0 12px 32px rgba(0,0,0,0.25)'
            }}
          >
            <h2 
              className="text-3xl md:text-4xl font-black tracking-tight"
              style={{ color: 'hsl(var(--brown-dark))' }}
            >
              Tenaga Kependidikan
            </h2>
          </div>
          <p 
            className="mt-6 text-lg max-w-2xl mx-auto"
            style={{ color: 'hsl(var(--cream))' }}
          >
            Tim pengajar profesional yang berdedikasi untuk pendidikan teknik otomasi industri
          </p>
        </div>

        {/* Horizontal Scroll Container */}
        <div className="relative">
          {/* Gradient Fade Left */}
          <div 
            className="absolute left-0 top-0 bottom-0 w-20 z-10 pointer-events-none"
            style={{
              background: 'linear-gradient(to right, hsl(var(--brown-medium)), transparent)'
            }}
          />
          
          {/* Gradient Fade Right */}
          <div 
            className="absolute right-0 top-0 bottom-0 w-20 z-10 pointer-events-none"
            style={{
              background: 'linear-gradient(to left, hsl(var(--brown-medium)), transparent)'
            }}
          />

          {/* Scrollable Cards Container */}
          <div
            ref={scrollContainerRef}
            onMouseDown={handleMouseDown}
            onMouseMove={handleMouseMove}
            onMouseUp={handleMouseUp}
            onMouseLeave={handleMouseLeave}
            className="flex gap-6 overflow-x-auto scrollbar-hide py-4 px-2"
            style={{
              cursor: isDragging ? 'grabbing' : 'grab',
              scrollBehavior: isDragging ? 'auto' : 'smooth',
              WebkitOverflowScrolling: 'touch'
            }}
          >
            {staffMembers.map((staff, index) => (
              <div
                key={index}
                className={`staff-card flex-shrink-0 ${visibleCards.includes(index) ? 'staff-card-visible' : ''}`}
                style={{
                  width: '320px',
                  opacity: visibleCards.includes(index) ? 1 : 0,
                  transform: visibleCards.includes(index) ? 'translateY(0)' : 'translateY(30px)',
                  transition: 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)'
                }}
              >
                <div 
                  className="group relative h-full rounded-2xl overflow-hidden shadow-xl hover-lift-staff"
                  style={{ 
                    background: 'white',
                    transition: 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)'
                  }}
                >
                  {/* Image Container */}
                  <div className="relative h-80 overflow-hidden">
                    <div 
                      className="absolute inset-0 bg-gradient-to-br from-yellow-500 to-orange-600 opacity-10 group-hover:opacity-20 transition-opacity duration-300"
                    />
                    <Image
                      src={staff.image}
                      alt={staff.name}
                      fill
                      className="object-cover staff-image pointer-events-none select-none"
                      draggable={false}
                      style={{
                        filter: 'grayscale(100%)',
                        objectPosition: 'center top',
                        transition: 'filter 0.3s ease, transform 0.5s ease'
                      }}
                      onError={(e) => {
                        const target = e.target as HTMLImageElement;
                        target.style.display = 'none';
                      }}
                    />
                    
                    {/* Gradient overlay on image */}
                    <div
                      style={{
                        position: 'absolute',
                        inset: 0,
                        background: 'linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.8) 100%)',
                        pointerEvents: 'none'
                      }}
                    />
                    
                    {/* Top gradient bar */}
                    <div 
                      className="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-500 to-orange-600"
                    />
                  </div>

                  {/* Text content */}
                  <div className="p-6">
                    <h3
                      className="text-lg font-bold mb-2 line-clamp-2"
                      style={{ 
                        color: 'hsl(var(--brown-dark))',
                        minHeight: '3rem',
                        lineHeight: '1.5rem'
                      }}
                    >
                      {staff.name}
                    </h3>
                    
                    <p 
                      className="text-sm text-gray-600"
                      style={{
                        minHeight: '1.25rem'
                      }}
                    >
                      {staff.role}
                    </p>

                    {/* Decorative bottom bar */}
                    <div 
                      className="mt-4 h-1 rounded-full bg-gradient-to-r from-amber-500 to-orange-600 staff-card-bar"
                      style={{ width: '0%' }}
                    />
                  </div>
                </div>
              </div>
            ))}
          </div>

          {/* Scroll Indicator */}
          <div className="flex justify-center mt-8 gap-2">
            <div className="flex items-center gap-2 px-4 py-2 rounded-full"
              style={{ 
                background: 'rgba(255, 255, 255, 0.1)',
                backdropFilter: 'blur(10px)'
              }}
            >
              {/* <svg 
                width="20" 
                height="20" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="hsl(var(--cream))" 
                strokeWidth="2"
              >
                <path d="M9 18l6-6-6-6"/>
              </svg> */}
              <span 
                className="text-sm font-semibold"
                style={{ color: 'hsl(var(--cream))' }}
              >
                Geser untuk melihat lebih banyak
              </span>
              {/* <svg 
                width="20" 
                height="20" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="hsl(var(--cream))" 
                strokeWidth="2"
              >
                <path d="M9 18l6-6-6-6"/>
              </svg> */}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}