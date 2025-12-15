"use client";

import Image from "next/image";
import { NavLink } from "./NavLink";
import { useEffect, useState, useRef } from "react";
import { gsap } from "gsap";

export default function Navigation() {
  const menuItems = [
    { label: "Home", href: "/" },
    { label: "About", href: "/#about" },
    { label: "Skills", href: "/#skills" },
    { label: "Tendik", href: "/#tendik" },
    { label: "Jenjang Karir", href: "/#career" },
  ];

  const [scrolled, setScrolled] = useState(false);
  const [activeSection, setActiveSection] = useState('home');
  const navRef = useRef<HTMLElement | null>(null);
  const logoRef = useRef<HTMLDivElement | null>(null);
  const pillRef = useRef<HTMLDivElement | null>(null);

  useEffect(() => {
    function onScroll() {
      setScrolled(window.scrollY > 20);
    }
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    const sections = ['home', 'about', 'skills', 'tendik', 'career'];
    const handleScroll = () => {
      const scrollY = window.scrollY + window.innerHeight / 2; // center of viewport
      let current = 'home';
      let maxBottom = 0;
      let bottomOfHome = 0;
      sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
          const rect = el.getBoundingClientRect();
          const top = rect.top + window.scrollY;
          const bottom = top + rect.height;
          maxBottom = Math.max(maxBottom, bottom);
          if (id === 'home') bottomOfHome = bottom;
          if (scrollY >= top && scrollY < bottom) {
            current = id;
          }
        }
      });
      if (scrollY < bottomOfHome) {
        current = 'home';
      }
      if (scrollY > maxBottom) {
        current = '';
      }
      setActiveSection(current);
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // initial check
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Smooth transition using GSAP (replaces Web Animations API)
  useEffect(() => {
    const logoEl = logoRef.current as HTMLElement | null;
    const pillEl = pillRef.current as HTMLElement | null;
    const navEl = navRef.current as HTMLElement | null;

    const tl = gsap.timeline({ defaults: { duration: 0.3, ease: "power2.out" } });

    if (logoEl) {
      tl.to(
        logoEl,
        { y: scrolled ? -6 : 0, scale: scrolled ? 0.9 : 1, opacity: scrolled ? 0.95 : 1 },
        0
      );
    }

    if (pillEl) {
      // animate vertical position; initial offset is -4px when not scrolled
      tl.to(pillEl, { y: scrolled ? -8 : -4 }, 0);
    }

    if (navEl) {
      // Animate backdrop filter by toggling between two values
      // gsap can animate filter/backdropFilter in modern browsers
      tl.to(navEl, { backdropFilter: scrolled ? "blur(0px)" : "blur(2px)" }, 0);
    }

    return () => {
      tl.kill();
    };
  }, [scrolled]);

  return (
    <nav
      ref={(el) => {
        navRef.current = el;
      }}
      className="fixed top-0 left-0 right-0 z-50 px-6 py-4 transition-colors duration-300"
      style={{ transform: 'translateY(-6px)' }}

    >
      <div className="container mx-auto relative">
        <div className="flex items-center justify-between relative">

          {/* Logo - keeps visible; white circle only when at top */}
          <div
            ref={(el) => {
              logoRef.current = el;
            }}
            className={`flex items-center gap-3 transition-colors duration-300 ${
              scrolled ? "bg-transparent p-0" : "bg-white rounded-full p-3"
            }`}
            style={{ transform: 'translateY(-4px)' }}
          >
            <Image
              src="/logo-toi.png"
              alt="SMK Logo"
              width={88}
              height={88}
              className="object-contain"
            />
          </div>

          {/* Menu Items (centered pill) - always visible, brown background */}
          <div
            ref={(el) => {
              pillRef.current = el;
            }}
            className="absolute left-[calc(50%+90px)] top-[25%] transform -translate-x-1/2 -translate-y-1/2 hidden md:flex items-center rounded-full shadow-lg"
            style={{
              background: "hsl(var(--brown-dark))",
              padding: '0.4rem 4.5rem',
              width: 'min(1120px, 96%)',
              justifyContent: 'center',
              gap: '1.25rem'
            }}
          >
            {menuItems.map((item) => (
              <NavLink
                key={item.label}
                href={item.href}
                activeSection={activeSection}
                className={
                  "transition-all duration-300 px-12 py-3 text-base font-semibold rounded-full hover:text-[hsl(var(--orange-bright))] hover:scale-105 text-[hsl(var(--yellow-warm))]"
                }
                activeClassName={"bg-[hsl(var(--yellow-warm))] text-[hsl(var(--brown-dark))] font-bold scale-105"}
              >
                {item.label}
              </NavLink>
            ))}
          </div>

          {/* Right spacer so logo and menu are visually balanced */}
          <div className="w-12" />
        </div>
      </div>
    </nav>
  );
}
