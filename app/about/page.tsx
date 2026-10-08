import { AboutPreview, WhyChoose } from "@/components/sections";

export default function AboutPage() {
  return (
    <main>
      <section className="page-title">
        <p className="eyebrow">About Prime Appliance Care</p>
        <h1>Reliable appliance repair service focused on helping homeowners.</h1>
      </section>
      <AboutPreview />
      <section className="section two-col">
        <div>
          <h2>Who We Are</h2>
          <p>
            Prime Appliance Care is a local service provider specializing in
            washing machine and refrigerator repair, with a practical approach
            to diagnosis, communication, and timely service.
          </p>
        </div>
        <div>
          <h2>Our Mission</h2>
          <p>
            To provide dependable, transparent, and convenient appliance repair
            services while keeping customer satisfaction first.
          </p>
        </div>
      </section>
      <WhyChoose />
    </main>
  );
}
