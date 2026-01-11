"use client";

import { useState, useRef, useEffect } from 'react';
import Image from 'next/image';

interface ChromaGridItem {
  image: string;
  name: string;
  role: string;
}

interface ChromaGridProps {
  items: ChromaGridItem[];
  accentColor?: string;
}

export default function ChromaGrid({ 
  items, 
  accentColor = 'hsl(var(--yellow-warm))' 
}: ChromaGridProps) {
  const [hoveredIndex, setHoveredIndex] = useState<number | null>(null);
  const [mousePosition, setMousePosition] = useState({ x: 0, y: 0 });
  const containerRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const handleMouseMove = (e: MouseEvent) => {
      if (containerRef.current) {
        const rect = containerRef.current.getBoundingClientRect();
        setMousePosition({
          x: e.clientX - rect.left,
          y: e.clientY - rect.top
        });
      }
    };

    const container = containerRef.current;
    if (container) {
      container.addEventListener('mousemove', handleMouseMove);
      return () => container.removeEventListener('mousemove', handleMouseMove);
    }
  }, []);

  return (
    <div 
      ref={containerRef}
      className="chroma-grid-container"
      style={{ 
        position: 'relative',
        padding: '2rem'
      }}
    >
      <div 
        className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        style={{ position: 'relative' }}
      >
        {items.map((item, index) => {
          const isHovered = hoveredIndex === index;
          
          return (
            <div
              key={index}
              className="chroma-card"
              onMouseEnter={() => setHoveredIndex(index)}
              onMouseLeave={() => setHoveredIndex(null)}
              style={{
                position: 'relative',
                borderRadius: '1rem',
                overflow: 'hidden',
                cursor: 'pointer',
                transition: 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
                transform: isHovered ? 'scale(1.05) translateY(-4px)' : 'scale(1)',
              }}
            >
              {/* Background overlay with accent color on hover */}
              <div
                className="chroma-overlay"
                style={{
                  position: 'absolute',
                  inset: 0,
                  background: isHovered 
                    ? `linear-gradient(135deg, ${accentColor} 0%, rgba(255, 193, 7, 0.6) 100%)`
                    : 'transparent',
                  opacity: isHovered ? 0.3 : 0,
                  transition: 'opacity 0.3s ease',
                  pointerEvents: 'none',
                  zIndex: 1
                }}
              />

              {/* Card border glow effect */}
              <div
                className="chroma-border"
                style={{
                  position: 'absolute',
                  inset: 0,
                  borderRadius: '1rem',
                  padding: '2px',
                  background: isHovered 
                    ? `linear-gradient(135deg, ${accentColor}, rgba(255, 193, 7, 0.8))`
                    : 'linear-gradient(135deg, rgba(0,0,0,0.1), rgba(0,0,0,0.1))',
                  WebkitMask: 'linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0)',
                  WebkitMaskComposite: 'xor',
                  maskComposite: 'exclude',
                  transition: 'all 0.3s ease',
                  pointerEvents: 'none',
                  zIndex: 2
                }}
              />

              {/* Card content */}
              <div
                style={{
                  position: 'relative',
                  background: 'linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%)',
                  borderRadius: '1rem',
                  overflow: 'hidden',
                  zIndex: 0
                }}
              >
                {/* Image container */}
                <div 
                  className="chroma-image-container"
                  style={{
                    position: 'relative',
                    width: '100%',
                    paddingBottom: '125%', // 4:5 aspect ratio
                    overflow: 'hidden'
                  }}
                >
                  <Image
                    src={item.image}
                    alt={item.name}
                    fill
                    className="object-cover"
                    style={{
                      filter: isHovered ? 'grayscale(0%) contrast(1.1)' : 'grayscale(100%)',
                      transition: 'filter 0.3s ease, transform 0.3s ease',
                      transform: isHovered ? 'scale(1.1)' : 'scale(1)'
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
                </div>

                {/* Text content */}
                <div
                  className="chroma-text"
                  style={{
                    padding: '1rem',
                    position: 'relative',
                    zIndex: 3
                  }}
                >
                  <h3
                    style={{
                      fontSize: '1rem',
                      fontWeight: 'bold',
                      color: 'white',
                      marginBottom: '0.25rem',
                      transition: 'color 0.3s ease'
                    }}
                  >
                    {item.name}
                  </h3>
                  <p
                    style={{
                      fontSize: '0.875rem',
                      color: isHovered ? accentColor : 'rgba(255, 255, 255, 0.6)',
                      transition: 'color 0.3s ease'
                    }}
                  >
                    {item.role}
                  </p>
                </div>

                {/* Shine effect on hover */}
                {isHovered && (
                  <div
                    className="chroma-shine"
                    style={{
                      position: 'absolute',
                      top: '-50%',
                      left: '-50%',
                      width: '200%',
                      height: '200%',
                      background: `radial-gradient(circle at ${mousePosition.x}px ${mousePosition.y}px, rgba(255, 255, 255, 0.1) 0%, transparent 50%)`,
                      pointerEvents: 'none',
                      transition: 'opacity 0.3s ease',
                      zIndex: 4
                    }}
                  />
                )}
              </div>
            </div>
          );
        })}
      </div>
    </div>
  );
}