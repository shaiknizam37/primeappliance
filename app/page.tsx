import { AboutPreview, Hero, ServicesGrid, TrustStrip, WhyChoose } from "@/components/sections";

export default function Home() {
  return (
    <main>
      <Hero />
      <TrustStrip />
      <ServicesGrid />
      <AboutPreview />
      <WhyChoose />
    </main>
  );
}
