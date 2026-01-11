import CircularGallery from './CircularGallery';

export default function StaffSection() {
  const staffMembers = [
    { name: "Nama Guru A", degree: "Matematika", image: "/indra.jfif" },
    { name: "Nama Guru B", degree: "Bahasa Inggris", image: "/eva.jfif" },
    { name: "Nama Guru C", degree: "Sejarah", image: "/ishri.jfif" },
    { name: "Nama Guru D", degree: "Fisika", image: "/kosimudin.jfif" },
    { name: "Nama Guru E", degree: "Biologi", image: "/farida.jfif" },
    { name: "Nama Guru F", degree: "Seni Budaya", image: "/syahida.jfif" },
    { name: "Nama Guru G", degree: "Pjok", image: "/dika.jfif" },
  ];

  const galleryItems = staffMembers.map((s, i) => ({
    image: s.image,
    // use newline so gallery renders name on first line and subject on second
    text: `${s.name}\n${s.degree}`
  }));

  return (
    <section id="tendik" className="py-16 w-full" style={{ background: 'hsl(var(--brown-medium))', border: 'none', boxShadow: 'none', outline: 'none' }}>
      <div className="mx-auto px-6">
        <div className="text-center mb-8">
          <div className="inline-block rounded-3xl px-12 py-4" style={{ background: 'hsl(var(--yellow-warm))' }}>
            <h2 className="text-3xl font-black" style={{ color: 'hsl(var(--brown-dark))' }}>Tenaga Pendidikan</h2>
          </div>
        </div>

        <div className="max-w-8xl mx-auto" style={{ border: 'none' }}>
          <div className="flex justify-center">
            <div className="w-full max-w-7xl" style={{ height: 450 }}>
              <CircularGallery items={galleryItems} bend={0} scrollSpeed={2} scrollEase={0.06} font={"bold 42px Figtree"} />
            </div>
          </div>
        </div>

        {/* Staff Cards Section */}
        {/* <div className="max-w-7xl mx-auto mt-16">
          <div className="text-center mb-12">
            <h3 className="text-2xl font-bold mb-4" style={{ color: 'hsl(var(--brown-dark))' }}>Daftar Tenaga Pendidikan</h3>
            <div className="w-24 h-1 bg-yellow-400 mx-auto rounded-full"></div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            {staffMembers.map((staff, index) => (
              <div
                key={index}
                className="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden"
              >
                <div className="relative overflow-hidden">
                  <img
                    src={staff.image}
                    alt={staff.name}
                    className="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                  />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div className="p-4 text-center">
                  <h4 className="text-lg font-bold mb-1" style={{ color: 'hsl(var(--brown-dark))' }}>
                    {staff.name}
                  </h4>
                  <p className="text-sm font-medium text-gray-600">
                    {staff.degree}
                  </p>
                </div>
              </div>
            ))}
          </div>
        </div> */}
      </div>
    </section>
  );
}
