import { MapPin, Phone, Mail } from "lucide-react";
import Image from "next/image";

export default function Footer() {
  return (
    <footer style={{ background: 'hsl(var(--cream))' }} className="py-12 relative overflow-hidden">
      <div className="absolute bottom-0 right-0 w-96 h-96 bg-orange-bright rounded-full blur-3xl opacity-20"></div>
      
      <div className="container mx-auto px-6 relative z-10">
        <div className="grid md:grid-cols-2 gap-12">
          <div className="space-y-6">
            <div className="flex items-center gap-4">
              <div className="bg-white rounded-full p-3">
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
              </div>
            </div>
            
            <div className="space-y-3 text-foreground">
              <div className="flex items-start gap-3">
                <MapPin className="w-5 h-5 text-orange-bright flex-shrink-0 mt-1" />
                <p className="text-sm">
                  SMKN 1 Cibinong, Jl. Raya Karadenan No.7, Karadenan, Cibinong, Bogor Regency, West Java 16111
                </p>
              </div>
              
              <div className="flex items-center gap-3">
                <Phone className="w-5 h-5 text-orange-bright" />
                <p className="text-sm">(+62) 2518663 846</p>
              </div>
              
              <div className="flex items-center gap-3">
                <Mail className="w-5 h-5 text-orange-bright" />
                <p className="text-sm">smkn1cibinongbgr@gmail.com</p>
              </div>
            </div>
          </div>
          
          <div className="grid grid-cols-2 gap-8">
            <div>
              <h4 className="font-bold text-brown-dark mb-3">Beranda</h4>
              <ul className="space-y-2 text-sm text-foreground">
                <li>Home</li>
                <li>About</li>
                <li>Skills</li>
                <li>Tendik</li>
                <li>Jenjang Karir</li>
              </ul>
            </div>
            
            <div>
              <h4 className="font-bold text-brown-dark mb-3">Tentang Kami</h4>
              <ul className="space-y-2 text-sm text-foreground">
                <li>Profil Sekolah</li>
                <li>Profil Jurusan</li>
              </ul>
            </div>
            
            <div>
              <h4 className="font-bold text-brown-dark mb-3">Portfolio</h4>
              <ul className="space-y-2 text-sm text-foreground">
                <li>AUTRA Inventaris</li>
                <li>AUTRA Monitoring</li>
              </ul>
            </div>
            
            <div>
              <h4 className="font-bold text-brown-dark mb-3">Tim Developer</h4>
              <ul className="space-y-2 text-sm text-foreground">
                <li>Aditya Ayu R.</li>
                <li>Damar Nugroho U.</li>
                <li>Rizki Zikrillah</li>
                <li>Sasqia Fatiazahra</li>
                <li>Tiara Ramadhini</li>
              </ul>
            </div>
          </div>
        </div>
        
        <div className="mt-12 pt-6 border-t border-border text-center">
          <p className="text-sm text-muted-foreground">
            © 2025. SMKN 1 Cibinong. All Rights Reserved.
          </p>
        </div>
      </div>
    </footer>
  );
};
