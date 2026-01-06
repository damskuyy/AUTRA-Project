"use client";

import { useState } from "react";
import { Card } from "@/components/ui/card";
import { ChevronLeft, ChevronRight } from "lucide-react";

export default function CareerSection() {
  const careers = [
    { title: "Control Engineer", salary: "Rp7.000.000 – Rp22.000.000 / bulan" },
    { title: "PLC Programmer", salary: "Rp6.500.000 – Rp25.000.000 / bulan" },
    { title: "SCADA Engineer", salary: "Rp7.000.000 – Rp23.000.000 / bulan" },

    { title: "Electrical Engineer (Industri)", salary: "Rp6.000.000 – Rp17.000.000 / bulan" },
    { title: "Power Plant Technician", salary: "Rp6.500.000 – Rp19.000.000 / bulan" },
    { title: "Energy Engineer", salary: "Rp7.000.000 – Rp20.000.000 / bulan" },

    { title: "Robotics Engineer / Technician", salary: "Rp6.000.000 – Rp20.000.000 / bulan" },
    { title: "Mechatronics Engineer", salary: "Rp6.500.000 – Rp18.000.000 / bulan" },
    { title: "Industrial IoT Engineer", salary: "Rp8.000.000 – Rp25.000.000 / bulan" },
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
      <div className="container mx-auto px-6">

        {/* HEADER */}
        <div className="text-center mb-6"> {/* dikurangi mb dari 12 -> 6 agar lebih dekat */}
          <div className="inline-block bg-orange-bright rounded-3xl px-12 py-6 mb-2"> {/* mb 4 -> 2 */}
            <h2 className="text-4xl font-black text-white">Career Path</h2>
            <p className="text-xl font-bold text-white">About Majors</p>
          </div>

          <p className="text-white max-w-3xl mx-auto text-lg mt-2"> {/* mt 4 -> 2 */}
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
            className="absolute left-[-60px] top-1/2 -translate-y-1/2
                       bg-orange-bright text-white p-3 rounded-full shadow-lg
                       disabled:opacity-40"
          >
            <ChevronLeft size={28} />
          </button>

          {/* BUTTON RIGHT */}
          <button
            onClick={() => setPage(page + 1)}
            disabled={page === totalPages - 1}
            className="absolute right-[-60px] top-1/2 -translate-y-1/2
                       bg-orange-bright text-white p-3 rounded-full shadow-lg
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
                      <Card
                        key={index}
                        className="bg-muted border border-orange-bright
                                   rounded-3xl shadow-md"
                      >
                        <div className="p-4">
                          <div className="bg-background rounded-2xl h-56 mb-4 shadow-sm" />

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
                    ))}
                </div>
              ))}
            </div>
          </div>
        </div>

        {/* DOT INDICATOR */}
        <div className="flex justify-center gap-3 mt-6"> {/* mt-8 -> mt-6 supaya lebih rapat */}
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
