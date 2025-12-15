"use client";

import Link, { LinkProps } from "next/link";
import { usePathname } from "next/navigation";
import { cn } from "@/lib/utils";

interface NavLinkProps extends Omit<LinkProps, "className"> {
  className?: string;
  activeClassName?: string;
  activeSection?: string;
  children: React.ReactNode; // <-- tambahkan ini
}

export function NavLink({
  href,
  className,
  activeClassName,
  activeSection,
  children,
  ...props
}: NavLinkProps) {
  const pathname = usePathname();
  const targetId = typeof href === 'string' && href.includes('#') ? href.split('#')[1] : 'home';
  const isActive = activeSection === targetId && activeSection !== '';

  const handleClick = (e: React.MouseEvent<HTMLAnchorElement>) => {
    if (typeof href === 'string') {
      if (href === "/") {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else if (href.includes('#')) {
        e.preventDefault();
        const targetId = href.split('#')[1];
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
          const rect = targetElement.getBoundingClientRect();
          const offset = targetId === 'about' ? -350 : 0; // adjust offset for about
          window.scrollTo({ top: window.scrollY + rect.top - offset, behavior: 'smooth' });
        }
      }
    }
  };

  return (
    <Link
      href={href}
      className={cn(className, isActive && activeClassName)}
      onClick={handleClick}
      {...props}
    >
      {children} {/* <- jangan lupa render children */}
    </Link>
  );
}
