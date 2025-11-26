"use client";

import Link, { LinkProps } from "next/link";
import { usePathname } from "next/navigation";
import { cn } from "@/lib/utils";

interface NavLinkProps extends Omit<LinkProps, "className"> {
  className?: string;
  activeClassName?: string;
  children: React.ReactNode; // <-- tambahkan ini
}

export function NavLink({
  href,
  className,
  activeClassName,
  children,
  ...props
}: NavLinkProps) {
  const pathname = usePathname();
  const isActive = pathname === href;

  return (
    <Link
      href={href}
      className={cn(className, isActive && activeClassName)}
      {...props}
    >
      {children} {/* <- jangan lupa render children */}
    </Link>
  );
}
