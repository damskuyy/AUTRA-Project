"use client";

import Image from "next/image";
import { NavLink } from "./NavLink";
import { useEffect, useState, useRef } from "react";
import { gsap } from "gsap";
import { Menu, X } from "lucide-react";

export default function Navigation() {
  const menuItems = [
    { label: "Home", href: "/" },
    { label: "About", href: "/#about" },
    { label: "Skills", href: "/#skills" },
    { label: "Prestasi", href: "/#prestasi" },
    { label: "Tendik", href: "/#tendik" },
    { label: "Jenjang Karir", href: "/#career" },
  ];

  const [scrolled, setScrolled] = useState(false);
  const [activeSection, setActiveSection] = useState("home");
  const [atFooter, setAtFooter] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

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
    const sections = ["home", "about", "skills", "prestasi", "tendik", "career"];

    const handleScroll = () => {
      if (atFooter) {
        setActiveSection('');
        return;
      }

      const scrollY = window.scrollY + 200;
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
  }, [atFooter]);

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
          scale: scrolled ? 0.9 : 1,
          y: scrolled ? -6 : 0,
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

  // Close mobile menu when clicking menu item
  const handleMenuClick = () => {
    setMobileMenuOpen(false);
  };

  // Prevent body scroll when menu is open
  useEffect(() => {
    if (mobileMenuOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'unset';
    }
    return () => {
      document.body.style.overflow = 'unset';
    };
  }, [mobileMenuOpen]);

  return (
    <>
      <nav
        ref={navRef}
        className="fixed top-0 left-0 right-0 z-50 px-4 py-3 md:px-6 md:py-4"
        style={{ 
          transform: "translateY(0)",
          background: 'transparent'
        }}
      >
        <div className="container mx-auto relative">
          <div className="flex items-center justify-between relative">

            {/* LOGO */}
            <div
              ref={logoRef}
              className="flex items-center gap-3 bg-white rounded-full p-2 md:p-3 shadow-lg"
              style={{ transform: "translateY(0)" }}
            >
              <Image
                src="/logo-toi.png"
                alt="SMK Logo"
                width={60}
                height={60}
                className="object-contain w-[50px] h-[50px] md:w-[60px] md:h-[60px]"
              />
            </div>

            {/* DESKTOP MENU */}
            <div
              ref={pillRef}
              className="absolute top-[25%] hidden md:flex items-center rounded-full shadow-lg"
              style={{
                left: "calc(50% + 90px)",
                transform: "translate(-50%, -50%)",
                background: "hsl(var(--brown-dark))",
                padding: "0.4rem 1rem",
                width: "min(1100px, 100%)",
                justifyContent: "center",
                gap: "1.5rem",
              }}
            >
              {menuItems.map((item) => (
                <NavLink
                  key={item.label}
                  href={item.href}
                  activeSection={activeSection}
                  className="px-12 py-3 text-base font-semibold rounded-full transition-all hover:text-[hsl(var(--orange-bright))] hover:scale-109 text-[hsl(var(--yellow-warm))]"
                  activeClassName="bg-[hsl(var(--yellow-warm))] text-[hsl(var(--brown-dark))] font-bold scale-105"
                >
                  {item.label}
                </NavLink>
              ))}
            </div>

            {/* MOBILE HAMBURGER BUTTON */}
            <button
              onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
              className="md:hidden flex items-center justify-center w-14 h-14 rounded-full bg-[hsl(var(--brown-dark))] text-[hsl(var(--yellow-warm))] shadow-xl z-[60] relative"
              aria-label="Toggle menu"
            >
              {mobileMenuOpen ? (
                <X className="w-6 h-6" />
              ) : (
                <Menu className="w-6 h-6" />
              )}
            </button>

            <div className="hidden md:block w-12" />
          </div>
        </div>
      </nav>

      {/* MOBILE MENU OVERLAY */}
      <div
        className={`fixed inset-0 bg-black/60 backdrop-blur-sm z-[45] md:hidden transition-opacity duration-300 ${
          mobileMenuOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
        }`}
        onClick={() => setMobileMenuOpen(false)}
      />

      {/* MOBILE MENU SIDEBAR */}
      <div
        className={`fixed top-0 right-0 bottom-0 w-[75%] max-w-[320px] z-[50] md:hidden transition-transform duration-300 ease-out ${
          mobileMenuOpen ? 'translate-x-0' : 'translate-x-full'
        }`}
        style={{
          background: 'hsl(var(--brown-dark))',
          boxShadow: '-4px 0 24px rgba(0, 0, 0, 0.4)'
        }}
      >
        <div className="flex flex-col h-full pt-28 pb-6 px-4 overflow-y-auto">
          {/* Menu Items */}
          <nav className="flex-1 space-y-1">
            {menuItems.map((item) => {
              const targetId = typeof item.href === 'string' && item.href.includes('#') 
                ? item.href.split('#')[1] 
                : 'home';
              const isActive = activeSection === targetId && activeSection !== '';

              return (
                <NavLink
                  key={item.label}
                  href={item.href}
                  activeSection={activeSection}
                  className={`block w-full px-5 py-4 rounded-xl text-left font-bold transition-all text-base ${
                    isActive 
                      ? 'bg-[hsl(var(--yellow-warm))] text-[hsl(var(--brown-dark))] shadow-lg transform scale-[1.02]' 
                      : 'text-[hsl(var(--yellow-warm))] hover:bg-white/10 hover:translate-x-1'
                  }`}
                  activeClassName="bg-[hsl(var(--yellow-warm))] text-[hsl(var(--brown-dark))]"
                >
                  <div onClick={handleMenuClick}>
                    {item.label}
                  </div>
                </NavLink>
              );
            })}
          </nav>

          {/* Menu Footer */}
          {/* <div className="pt-6 mt-4 border-t border-[hsl(var(--yellow-warm))]/30 flex-shrink-0">
            <div className="text-center space-y-1">
              <p 
                className="text-sm font-bold"
                style={{ color: 'hsl(var(--yellow-warm))' }}
              >
                SMK N 1 Cibinong
              </p>
              <p 
                className="text-xs font-medium"
                style={{ color: 'hsl(var(--cream))', opacity: 0.8 }}
              >
                Teknik Otomasi Industri
              </p>
            </div>
          </div> */}
        </div>
      </div>
    </>
  );
}