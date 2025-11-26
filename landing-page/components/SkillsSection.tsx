import { Card } from "@/components/ui/card";
import { Edit } from "lucide-react";

export default function SkillsSection() {
  const skills = [
    { name: "Nama Skill", description: "Deskripsi skill" },
    { name: "Nama Skill", description: "Deskripsi skill" },
    { name: "Nama Skill", description: "Deskripsi skill" },
  ];

  return (
    <section
      className="py-16"
      style={{ background: 'linear-gradient(135deg, hsl(var(--brown-medium)) 0%, hsl(var(--brown-dark)) 50%, hsl(var(--brown-medium)) 100%)' }}
    >
      <div className="container mx-auto px-6">
        <div className="text-center mb-10">
          <div className="inline-block rounded-3xl px-8 py-3" style={{ background: 'hsl(var(--orange-bright))' }}>
            <h2 className="text-2xl font-black" style={{ color: 'hsl(var(--brown-dark))' }}>Skill For Automotive</h2>
          </div>
        </div>

        <div className="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
          {skills.map((skill, index) => (
            <div key={index} className="rounded-3xl overflow-hidden shadow-xl">
              <div style={{ background: 'hsl(var(--orange-bright))' }} className="p-4 rounded-t-3xl">
                <h3 className="text-lg font-bold" style={{ color: 'hsl(var(--brown-dark))' }}>{skill.name}</h3>
              </div>
              <div className="bg-background p-6 rounded-b-3xl">
                <div className="h-36 bg-[hsl(var(--cream))] rounded-md mb-4"></div>
                <p className="text-sm text-foreground/80">{skill.description}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
