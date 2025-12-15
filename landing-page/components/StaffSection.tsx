import CircularGallery from './CircularGallery';

export default function StaffSection() {
  const staffMembers = [
    { name: "Nama Guru A", degree: "Matematika" },
    { name: "Nama Guru B", degree: "Bahasa Inggris" },
    { name: "Nama Guru C", degree: "Sejarah" },
    { name: "Nama Guru D", degree: "Fisika" },
    { name: "Nama Guru E", degree: "Biologi" },
    { name: "Nama Guru F", degree: "Seni Budaya" },
  ];

  const galleryItems = staffMembers.map((s, i) => ({
    image: `https://picsum.photos/seed/staff-${i}-${encodeURIComponent(s.name)}/800/600`,
    // use newline so gallery renders name on first line and subject on second
    text: `${s.name}\n${s.degree}`
  }));

  return (
    <section id="tendik" className="py-16 w-full" style={{ background: 'hsl(var(--brown-medium))', border: 'none', boxShadow: 'none', outline: 'none' }}>
      <div className="mx-auto px-6">
        <div className="text-center mb-8">
          <div className="inline-block rounded-3xl px-12 py-4" style={{ background: 'hsl(var(--orange-bright))' }}>
            <h2 className="text-3xl font-black" style={{ color: 'hsl(var(--brown-dark))' }}>Tenaga Pendidikan</h2>
          </div>
        </div>

        <div className="max-w-8xl mx-auto" style={{ border: 'none' }}>
          <div className="flex justify-center">
            <div className="w-full max-w-7xl" style={{ height: 450 }}>
              <CircularGallery items={galleryItems} bend={0} scrollSpeed={2} scrollEase={0.06} font={"bold 36px Figtree"} />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
