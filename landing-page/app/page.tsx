import Navigation from "@/components/Navigation";
import HeroSection from "@/components/HeroSection";
import InformationSection from "@/components/InformationSection";
import SkillsSection from "@/components/SkillsSection";
import PrestasiSection from "@/components/PrestasiSection";
import StaffSection from "@/components/StaffSection";
import CareerSection from "@/components/CareerSection";
import Footer from "@/components/Footer";
import { Toaster } from "@/components/ui/toaster";
import type { ComponentType } from "react";

export default function Page() {
  const Nav = Navigation as unknown as ComponentType<any>;

  return (
    <div className="min-h-screen">
      <Nav />
      <HeroSection />
      <InformationSection />
      <SkillsSection />
      {/* <PrestasiSection /> */}
      <StaffSection />
      <CareerSection />
      <Footer />
      <Toaster />
    </div>
  );
};

