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
  const [activeSection, setActiveSection] = useState("home");
  const [atFooter, setAtFooter] = useState(false);

  const navRef = useRef<HTMLElement | null>(null);
  const logoRef = useRef<HTMLDivElement | null>(null);
  const pillRef = useRef<HTMLDivElement | null>(null);

  useEffect(() => {
    const onScroll = () => {
      setScrolled(window.scrollY > 20);
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    const sections = ["home", "about", "skills", "tendik", "career"];

    const handleScroll = () => {
      const scrollY = window.scrollY + window.innerHeight / 2;
      let current = "home";

      sections.forEach((id) => {
        const el = document.getElementById(id);
        if (!el) return;

        const top = el.offsetTop;
        const bottom = top + el.offsetHeight;
        if (scrollY >= top && scrollY < bottom) {
          current = id;
        }
      });

      setActiveSection(current);
    };

    window.addEventListener("scroll", handleScroll, { passive: true });
    handleScroll();
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  useEffect(() => {
    const footer = document.querySelector("footer");
    if (!footer) return;

    const observer = new IntersectionObserver(
      ([entry]) => {
        setAtFooter(entry.isIntersecting);
      },
      { threshold: 0.2 }
    );

    observer.observe(footer);
    return () => observer.disconnect();
  }, []);

  useEffect(() => {
    const tl = gsap.timeline({
      defaults: { duration: 0.4, ease: "power3.out" },
    });

    if (logoRef.current) {
      tl.to(
        logoRef.current,
        {
          opacity: atFooter ? 0 : 1,
          scale: atFooter ? 0.7 : scrolled ? 0.9 : 1,
          y: atFooter ? -30 : scrolled ? -6 : 0,
          pointerEvents: atFooter ? "none" : "auto",
        },
        0
      );
    }

    if (pillRef.current) {
      tl.to(
        pillRef.current,
        {
          left: atFooter ? "50%" : "calc(50% + 90px)",
          xPercent: -50,
          y: scrolled ? -8 : -4,
        },
        0
      );
    }

    if (navRef.current) {
      tl.to(
        navRef.current,
        {
          backdropFilter: scrolled ? "blur(0px)" : "blur(2px)",
        },
        0
      );
    }

    return () => {
      tl.kill();
    };
  }, [scrolled, atFooter]);

  return (
    <nav
      ref={navRef}
      className="fixed top-0 left-0 right-0 z-50 px-6 py-4"
      style={{ transform: "translateY(-6px)" }}
    >
      <div className="container mx-auto relative">
        <div className="flex items-center justify-between relative">

          {/* LOGO */}
          <div
            ref={logoRef}
            className="flex items-center gap-3 bg-white rounded-full p-3"
            style={{ transform: "translateY(-4px)" }}
          >
            <Image
              src="/logo-toi.png"
              alt="SMK Logo"
              width={85}
              height={85}
              className="object-contain"
            />
          </div>

          {/* MENU */}
          <div
            ref={pillRef}
            className="absolute top-[25%] hidden md:flex items-center rounded-full shadow-lg"
            style={{
              left: "calc(50% + 90px)",
              transform: "translate(-50%, -50%)",
              background: "hsl(var(--brown-dark))",
              padding: "0.4rem 1rem",
              width: "min(1000px, 100%)",
              justifyContent: "center",
              gap: "3rem",
            }}
          >
            {menuItems.map((item) => (
              <NavLink
                key={item.label}
                href={item.href}
                activeSection={activeSection}
                className="px-12 py-3 text-base font-semibold rounded-full transition-all hover:text-[hsl(var(--orange-bright))] hover:scale-105 text-[hsl(var(--yellow-warm))]"
                activeClassName="bg-[hsl(var(--yellow-warm))] text-[hsl(var(--brown-dark))] font-bold scale-105"
              >
                {item.label}
              </NavLink>
            ))}
          </div>

          <div className="w-12" />
        </div>
      </div>
    </nav>
  );
}
