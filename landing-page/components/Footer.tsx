import { MapPin, Phone, Mail, Instagram } from "lucide-react";
import Image from "next/image";

export default function Footer() {
  return (
    <footer style={{ background: 'hsl(var(--cream))' }} className="py-12 relative overflow-hidden border-t border-border">
      <div className="absolute bottom-0 right-0 w-64 h-64 bg-orange-bright rounded-full blur-2xl opacity-15"></div>
      
      <div className="container mx-auto px-6 relative z-10">
        <div className="grid md:grid-cols-2 gap-12">
          <div className="space-y-6">
            <div className="flex items-center gap-4">
              <div className="bg-white rounded-full p-3 shadow-lg">
                <Image
                  src="/logo-toi.png"
                  alt="SMK Logo"
                  width={88}
                  height={88}
                  className="object-contain"
                />
              </div>
              <div>
                <h3 className="text-2xl font-black text-brown-dark">SMK N 1 CIBINONG</h3>
                <p className="text-sm text-muted-foreground">Teknik Otomasi Industri</p>
              </div>
            </div>
            
            <div className="space-y-4 text-foreground">
              <a
                href="https://maps.google.com/?q=SMKN+1+Cibinong,+Jl.+Raya+Karadenan+No.7,+Karadenan,+Cibinong,+Bogor+Regency,+West+Java+16111"
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-start gap-3 hover:text-orange-bright transition-colors group"
              >
                <MapPin className="w-5 h-5 text-orange-bright flex-shrink-0 mt-1 group-hover:scale-110 transition-transform" />
                <p className="text-sm leading-relaxed">
                  SMKN 1 Cibinong, Jl. Raya Karadenan No.7, Karadenan, Cibinong, Bogor Regency, West Java 16111
                </p>
              </a>
              
              <a
                href="tel:+622518663846"
                className="flex items-center gap-3 hover:text-orange-bright transition-colors group"
              >
                <Phone className="w-5 h-5 text-orange-bright group-hover:scale-110 transition-transform" />
                <p className="text-sm">(+62) 251 8663 846</p>
              </a>
              
              <a
                href="mailto:smkn1cibinongbgr@gmail.com"
                className="flex items-center gap-3 hover:text-orange-bright transition-colors group"
              >
                <Mail className="w-5 h-5 text-orange-bright group-hover:scale-110 transition-transform" />
                <p className="text-sm">smkn1cibinongbgr@gmail.com</p>
              </a>
            </div>
          </div>
          
          <div className="grid grid-cols-2 gap-8">
            <div>
              <h4 className="font-bold text-brown-dark mb-4 text-lg">Beranda</h4>
              <ul className="space-y-3 text-sm">
                <li><a href="#home" className="text-foreground hover:text-orange-bright transition-colors">Home</a></li>
                <li><a href="#information" className="text-foreground hover:text-orange-bright transition-colors">About</a></li>
                <li><a href="#skills" className="text-foreground hover:text-orange-bright transition-colors">Skills</a></li>
                <li><a href="#staff" className="text-foreground hover:text-orange-bright transition-colors">Tendik</a></li>
                <li><a href="#career" className="text-foreground hover:text-orange-bright transition-colors">Jenjang Karir</a></li>
              </ul>
            </div>
            
            <div>
              <h4 className="font-bold text-brown-dark mb-4 text-lg">Tentang Kami</h4>
              <ul className="space-y-3 text-sm">
                <li><a href="https://smkn1cibinong.sch.id" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors">Profil Sekolah</a></li>
                <li><a href="/" className="text-foreground hover:text-orange-bright transition-colors">Profil Jurusan</a></li>
              </ul>
            </div>
            
            <div>
              <h4 className="font-bold text-brown-dark mb-4 text-lg">Portfolio</h4>
              <ul className="space-y-3 text-sm">
                <li><a href="http://localhost:8002/" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors">AUTRA Inventaris</a></li>
                <li><a href="http://localhost:8001/dashboard" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors">AUTRA Monitoring</a></li>
              </ul>
            </div>
            
            <div>
              <h4 className="font-bold text-brown-dark mb-4 text-lg flex items-center gap-2">
                Tim Developer
                {/* <Instagram className="w-4 h-4 text-orange-bright" /> */}
              </h4>
              <ul className="space-y-3 text-sm">
                <li><a href="https://www.instagram.com/tyarmdhanii/" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors flex items-center gap-2">
                  Aditya Ayu R.
                </a></li>
                <li><a href="https://www.instagram.com/damarrngrh_/" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors flex items-center gap-2">
                  Damar Nugroho U. 
                </a></li>
                <li><a href="https://www.instagram.com/ajijonnnnnnnnnn_/" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors flex items-center gap-2">
                  Rizki Zikrillah 
                </a></li>
                <li><a href="https://www.instagram.com/sassyqi_/" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors flex items-center gap-2">
                  Sasqia Fatiazahra 
                </a></li>
                <li><a href="https://www.instagram.com/tiararamadhinii/" target="_blank" rel="noopener noreferrer" className="text-foreground hover:text-orange-bright transition-colors flex items-center gap-2">
                  Tiara Ramadhini 
                </a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div className="mt-12 pt-8 border-t border-border text-center">
          <p className="text-sm text-muted-foreground">
            © 2025. SMKN 1 Cibinong - Teknik Otomasi Industri. All Rights Reserved.
          </p>
          {/* <p className="text-xs text-muted-foreground mt-2">
            Dibuat dengan ❤️ oleh Tim Developer AUTRA
          </p> */}
        </div>
      </div>
    </footer>
  );
};
