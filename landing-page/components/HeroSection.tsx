
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
          background: 'hsl(var(--cream))',
          paddingTop: '10rem',
          paddingBottom: '6.5rem',
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
                  src="/assets/mascot.png"
                  alt="SMK Mascot"
                  width={380}
                  height={380}
                  className="w-72 h-72 md:w-[380px] md:h-[380px] object-contain"
                />
              </div>
            </div>

            {/* Content column */}
            <div className="space-y-6 flex flex-col items-center md:items-start">
              <div
                className="rounded-lg p-6 shadow-2xl"
                style={{
                  background: 'hsl(var(--yellow-warm))',
                  borderRadius: '18px',
                  boxShadow: '0 18px 40px rgba(0,0,0,0.22)',
                  width: 'min(520px, 100%)',
                  border: '6px solid rgba(0,0,0,0.04)'
                }}
              >
                <h1
                  className="text-4xl md:text-5xl font-extrabold text-center md:text-left"
                  style={{ color: 'hsl(var(--brown-dark))', fontFamily: 'Impact, sans-serif', letterSpacing: '0.04em', textShadow: '2px 2px 0 rgba(0,0,0,0.06)' }}
                >
                  WELCOME
                </h1>
                <p
                  className="text-sm md:text-base font-semibold mt-1"
                  style={{ color: 'hsl(var(--brown-dark) / 0.85)', fontFamily: 'Georgia, serif', letterSpacing: '0.02em' }}
                >
                  TO THE WORLD OF AUTOMATION
                </p>
              </div>

              <p className="text-base text-foreground/90 text-center md:text-left max-w-lg">Jurusan ini mempunyai dua platform berbeda.</p>

              <div className="flex gap-4 justify-center md:justify-start">
                <Button
                  className="font-bold px-6 py-3 text-sm rounded-xl shadow-md flex items-center gap-3"
                  style={{ background: 'hsl(var(--brown-dark))', color: 'hsl(var(--yellow-warm))', boxShadow: '0 6px 18px rgba(0,0,0,0.18)' }}
                >
                  <span>Inventaris</span>
                  <span className="text-[1.1rem]">›</span>
                </Button>

                <Button
                  className="font-bold px-6 py-3 text-sm rounded-xl shadow-md flex items-center gap-3"
                  style={{ background: 'hsl(var(--brown-dark))', color: 'hsl(var(--yellow-warm))', boxShadow: '0 6px 18px rgba(0,0,0,0.18)' }}
                >
                  <span>Monitoring</span>
                  <span className="text-[1.1rem]">›</span>
                </Button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

