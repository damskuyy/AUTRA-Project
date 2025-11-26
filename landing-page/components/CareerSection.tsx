import { Card } from "@/components/ui/card";

export default function CareerSection() {
  const careers = [
    { title: "Nama Karir", salary: "Gaji nya" },
    { title: "Nama Karir", salary: "Gaji nya" },
  ];

  return (
    <section className="py-16" style={{ background: 'hsl(var(--brown-dark))' }}>
      <div className="container mx-auto px-6">
        <div className="text-center mb-8">
          <div className="inline-block bg-orange-bright rounded-3xl px-12 py-6 mb-4">
            <h2 className="text-4xl font-black text-brown-dark">Career Path</h2>
            <p className="text-xl font-bold text-brown-dark">About Majors</p>
          </div>
          
          <p className="text-cream max-w-3xl mx-auto text-lg">
            Peluang kariermu luas banget! Nih, ada beberapa pilihan karier keren buat kamu yang siap ahli otomasi masa depan.
          </p>
        </div>
        
        <div className="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-8">
          {careers.map((career, index) => (
            <Card key={index} className="bg-muted border-4 border-orange-bright rounded-3xl overflow-hidden shadow-xl hover-scale">
              <div className="p-6">
                <div className="bg-background rounded-2xl h-48 mb-4"></div>
                <div className="text-center">
                  <p className="text-sm text-foreground mb-1">({career.title})</p>
                  <p className="text-xs text-muted-foreground">({career.salary})</p>
                </div>
              </div>
            </Card>
          ))}
        </div>
        
        <div className="flex justify-center gap-2">
          {[...Array(6)].map((_, i) => (
            <div
              key={i}
              className={`w-3 h-3 rounded-full ${i === 0 ? 'bg-cream' : 'bg-cream/30'}`}
            />
          ))}
        </div>
      </div>
    </section>
  );
};

