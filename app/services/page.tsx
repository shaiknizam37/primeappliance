import { ServicesGrid, WhyChoose } from "@/components/sections";

export default function ServicesPage() {
  return (
    <main>
      <section className="page-title service-title">
        <p className="eyebrow">Professional repair solutions</p>
        <h1>Our Appliance Repair Services</h1>
        <p>Focused repair support for essential home appliances.</p>
      </section>
      <ServicesGrid compact />
      <WhyChoose />
    </main>
  );
}
