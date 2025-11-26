import { useState, useEffect } from "react";

const MOBILE_BREAKPOINT = 768;

export function useIsMobile() {
  const [isMobile, setIsMobile] = useState<boolean>(false);

  useEffect(() => {
    if (typeof window === "undefined") return; // safety check untuk SSR

    const checkMobile = () => setIsMobile(window.innerWidth < MOBILE_BREAKPOINT);

    const mql = window.matchMedia(`(max-width: ${MOBILE_BREAKPOINT - 1}px)`);

    // set initial value
    checkMobile();

    // listen for changes
    mql.addEventListener("change", checkMobile);

    return () => mql.removeEventListener("change", checkMobile);
  }, []);

  return isMobile;
}
