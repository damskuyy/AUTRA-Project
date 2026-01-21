"use client";

import { Button } from "@/components/ui/button";
import Image from "next/image";

export default function HeroSection() {
  return (
    <div style={{ position: 'relative' }}>

      {/* left-bottom orange circle behind mascot (placed low and partially covered by brown curve) */}
      {/* <div
        aria-hidden
        className="absolute rounded-full z-[1]"
        style={{
          left: '-120px',
          bottom: '-20px',
          width: '400px',
          height: '400px',
          background: 'hsl(var(--orange-bright))',
        }}
      /> */}

      {/* Brown background for area below section radius */}
      {/* <div
        aria-hidden
        style={{
          position: 'absolute',
          left: 0,
          right: 0,
          bottom: 0,
          height: '200px', // adjust as needed
          background: 'hsl(var(--brown-medium))',
          zIndex: 2,
        }}
      /> */}
      <section id="home"
        className="relative"
        style={{
          background: 'rgb(249, 249, 249)',
          paddingTop: '7rem',
          paddingBottom: '4rem',
          minHeight: '675px',
          borderBottomLeftRadius: '220px',
          borderBottomRightRadius: '220px',
          position: 'relative',
          overflow: 'visible',
          zIndex: 0,
        }}
      >
        

        <div className="container mx-auto px-6 relative z-20">
          <div className="grid md:grid-cols-2 gap-10 items-center max-w-6xl mx-auto">
            {/* Mascot column */}
            <div className="flex justify-center md:justify-start relative">
              <div className="relative z-30" style={{ marginLeft: '-8px' }}>
                <Image
                  src="https://res.cloudinary.com/dqzc35nrh/image/upload/v1768921206/IMG_1494_dkbrlx.gif"
                  alt="SMK Mascot"
                  width={480}
                  height={480}
                  unoptimized={true}
                  className="w-100 h-100 md:w-[520px] md:h-[520px] object-contain"
                />
              </div>
            </div>

            {/* Content column */}
            <div className="space-y-6 flex flex-col items-center md:items-start">
              <div
                className="rounded-lg p-12 shadow-2xl"
                style={{
                  background: 'hsl(var(--yellow-warm))',
                  borderRadius: '32px',
                  boxShadow: '0 20px 50px rgba(49, 48, 48, 0.25)',
                  width: 'min(700px, 100%)',
                  border: '6px solid rgba(229, 121, 32, 0.85)'
                }}
              >
                <h1
                  className="text-7xl md:text-8xl font-extrabold text-center md:text-left"
                  style={{ color: 'hsl(var(--brown-dark))', fontFamily: 'Impact, sans-serif', letterSpacing: '0.05em', textShadow: '2px 2px 0 rgba(0,0,0,0.06)' }}
                >
                  WELCOME
                </h1>
                <p
                  className="text-base md:text-lg font-semibold mt-1"
                  style={{ color: 'hsl(var(--brown-dark) / 0.85)', fontFamily: 'Georgia, serif', letterSpacing: '0.02em' }}
                >
                  TO THE WORLD OF AUTOMATION
                </p>
              </div>

              <p className="text-lg text-foreground/90 text-center md:text-left max-w-lg">Jurusan ini mempunyai dua platform berbeda.</p>

              <div className="flex gap-4 justify-center md:justify-start">
                <Button
                  onClick={() => window.location.href = 'http://localhost:8000/dashboard'}
                  className="font-bold px-6 py-3 text-sm rounded-xl shadow-md flex items-center gap-3"
                  style={{ background: 'hsl(var(--brown-dark))', color: 'hsl(var(--yellow-warm))', boxShadow: '0 6px 18px rgba(0,0,0,0.18)' }}
                >
                  <span>Inventaris</span>
                  <span className="text-lg">›</span>
                </Button>

                <Button
                  onClick={() => window.location.href = 'http://localhost:8000/dashboard'}
                  className="font-bold px-6 py-3 text-sm rounded-xl shadow-md flex items-center gap-3"
                  style={{ background: 'hsl(var(--brown-dark))', color: 'hsl(var(--yellow-warm))', boxShadow: '0 6px 18px rgba(0,0,0,0.18)' }}
                >
                  <span>Monitoring</span>
                  <span className="text-lg">›</span>
                </Button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}