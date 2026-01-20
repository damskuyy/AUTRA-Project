"use client";

import { useState } from "react";
import { Card } from "@/components/ui/card";
import { ChevronLeft, ChevronRight } from "lucide-react";

export default function CareerSection() {
  const careers = [
    { 
      title: "Control Engineer", 
      salary: "Rp7.000.000 – Rp22.000.000 / bulan", 
      image: "/karir/controller.png",
      url: "https://news.bsi.ac.id/berita/edukasi/control-engineer-program-studi-teknik-industri/"
    },
    { 
      title: "PLC Programmer", 
      salary: "Rp6.500.000 – Rp25.000.000 / bulan", 
      image: "/karir/plc.png",
      url: "https://maukuliah.id/jobs/spesialis-plc-1"
    },
    { 
      title: "SCADA Engineer", 
      salary: "Rp7.000.000 – Rp23.000.000 / bulan", 
      image: "/karir/scada.png",
      url: "https://www.ziprecruiter.com/career/Scada-Engineer/What-Is-How-to-Become"
    },

    {
      title: "Electrical Engineer (Industri)",
      salary: "Rp6.000.000 – Rp17.000.000 / bulan",
      image: "/karir/electrical.png",
      url: "https://campus.quipper.com/careers/teknisi-listrik-electrical-engineer"
    },
    {
      title: "Power Plant Technician",
      salary: "Rp6.500.000 – Rp19.000.000 / bulan",
      image: "/karir/powerplan.png",
      url: "https://www.ziprecruiter.com/career/Power-Plant-Technician/What-Is-How-to-Become"
    },
    { 
      title: "Energy Engineer", 
      salary: "Rp7.000.000 – Rp20.000.000 / bulan", 
      image: "/karir/energy.png",
      url: "https://www.ece.fr/en/everything-you-need-to-know-about-the-renewable-energy-engineering-profession-studies-salary/"
    },

    {
      title: "Robotics Engineer / Technician",
      salary: "Rp6.000.000 – Rp20.000.000 / bulan",
      image: "/karir/roboticts.png",
      url: "https://campus.quipper.com/careers/teknisi-robot"
    },
    {
      title: "Mechatronics Engineer",
      salary: "Rp6.500.000 – Rp18.000.000 / bulan",
      image: "/karir/mechatronics.png",
      url: "https://www.careerexplorer.com/careers/mechatronics-engineer/#:~:text=Apa%20itu%20Insinyur%20Mekatronika?,peningkatan%20fungsionalitas%20dalam%20berbagai%20aplikasi."
    },
    {
      title: "Industrial IoT Engineer",
      salary: "Rp8.000.000 – Rp25.000.000 / bulan",
      image: "/karir/IoT.png",
      url: "https://soracom.io/blog/what-does-it-mean-to-be-an-iot-engineer/#:~:text=Apa%20Artinya%20Menjadi%20Insinyur%20IoT?&text=Istilah%20%22Insinyur%20IoT%22%20mencakup%20puluhan,contoh%20aplikasi%20dalam%20kategori%20tersebut."
    },
  ];

  const itemsPerPage = 3;
  const totalPages = Math.ceil(careers.length / itemsPerPage);
  const [page, setPage] = useState(0);

  return (
    <section
      id="career"
      className="py-16 relative overflow-hidden"
      style={{ background: "hsl(var(--brown-dark))" }}
    >
      <div 
        className="absolute top-10 right-10 w-72 h-72 rounded-full opacity-5"
        style={{ background: 'hsl(var(--yellow-warm))' }}
      />
      <div 
        className="absolute bottom-10 left-10 w-96 h-96 rounded-full opacity-5"
        style={{ background: 'hsl(var(--orange-bright))' }}
      />
      <div className="container mx-auto px-6">
        {/* HEADER */}
        <div className="text-center mb-12">
          <div
            className="inline-block rounded-full px-12 py-4 shadow-2xl staff-header"
            style={{
              background: "hsl(var(--yellow-warm))",
              boxShadow: "0 12px 32px rgba(0,0,0,0.25)",
            }}
          >
            <h2
              className="text-3xl md:text-4xl font-black tracking-tight"
              style={{ color: "hsl(var(--brown-dark))" }}
            >
              Career Path
            </h2>
          </div>
          <p
            className="mt-6 text-lg max-w-2xl mx-auto"
            style={{ color: "hsl(var(--cream))" }}
          >
            Peluang kariermu luas banget! Nih, ada beberapa pilihan karier keren
            buat kamu yang siap ahli otomasi masa depan.
          </p>
        </div>

        {/* SLIDER */}
        <div className="relative max-w-6xl mx-auto">
          {/* BUTTON LEFT */}
          <button
            onClick={() => setPage(page - 1)}
            disabled={page === 0}
            className="absolute left-[-60px] top-1/2 -translate-y-1/2 bg-orange-bright text-white p-3 rounded-full shadow-lg border-2 border-white disabled:opacity-40"
          >
            <ChevronLeft size={28} />
          </button>

          {/* BUTTON RIGHT */}
          <button
            onClick={() => setPage(page + 1)}
            disabled={page === totalPages - 1}
            className="absolute right-[-60px] top-1/2 -translate-y-1/2
                       bg-orange-bright text-white p-3 rounded-full shadow-lg border-2 border-white
                       disabled:opacity-40"
          >
            <ChevronRight size={28} />
          </button>

          {/* SLIDER CONTENT */}
          <div className="overflow-hidden">
            <div
              className="flex transition-transform duration-700 ease-in-out"
              style={{ transform: `translateX(-${page * 100}%)` }}
            >
              {Array.from({ length: totalPages }).map((_, pageIndex) => (
                <div
                  key={pageIndex}
                  className="min-w-full grid grid-cols-1 md:grid-cols-3 gap-8 px-2"
                >
                  {careers
                    .slice(
                      pageIndex * itemsPerPage,
                      pageIndex * itemsPerPage + itemsPerPage
                    )
                    .map((career, index) => (
                      <a
                        key={index}
                        href={career.url}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="no-underline"
                      >
                        <Card
                          className="bg-muted border border-orange-bright rounded-3xl shadow-md hover:shadow-lg transition-shadow cursor-pointer"
                        >
                          <div className="p-4">
                            <img
                              src={career.image}
                              alt={career.title}
                              className="bg-background rounded-2xl h-56 mb-4 shadow-sm object-cover w-full"
                            />
                            <div className="text-center">
                              <p className="text-sm font-medium text-foreground">
                                ({career.title})
                              </p>
                              <p className="text-xs text-muted-foreground">
                                ({career.salary})
                              </p>
                            </div>
                          </div>
                        </Card>
                      </a>
                    ))}
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* DOT INDICATOR */}
        <div className="flex justify-center gap-3 mt-6">
          {" "}
          {/* mt-8 -> mt-6 supaya lebih rapat */}
          {Array.from({ length: totalPages }).map((_, i) => (
            <button
              key={i}
              onClick={() => setPage(i)}
              className={`w-3 h-3 rounded-full transition ${
                page === i ? "bg-white scale-125" : "bg-white/30"
              }`}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
