import Image from "next/image";
import Link from "next/link";
import { ContactForm } from "@/components/contact-form";
import { contact, faqs, services, trustPoints } from "@/lib/site-data";

export function Hero() {
  return (
    <section className="hero">
      <div className="hero-copy">
        <p className="eyebrow">Professional Appliance Repair Services</p>
        <h1>
          Washing Machine & Refrigerator Repair <span>You Can Rely On</span>
        </h1>
        <p>
          Fast, reliable appliance repair by experienced technicians. Get your
          appliance working again with clear pricing and doorstep service.
        </p>
        <div className="button-row">
          <a className="btn btn-whatsapp" href={contact.whatsappHref}>
            WhatsApp Us
          </a>
          <Link className="btn btn-call" href="/contact">
            Book a Service
          </Link>
        </div>
        <div className="hero-badges">
          <span>Experienced Technicians</span>
          <span>Transparent Pricing</span>
          <span>Doorstep Service</span>
        </div>
      </div>
      <div className="hero-image">
        <Image
          src="/images/hero-technician.png"
          alt="Technician repairing a washing machine at home"
          fill
          priority
          sizes="(max-width: 760px) 100vw, 54vw"
        />
      </div>
    </section>
  );
}

export function TrustStrip() {
  return (
    <section className="trust-strip">
      {trustPoints.map(([title, text]) => (
        <article key={title}>
          <span className="icon-dot">✓</span>
          <div>
            <h3>{title}</h3>
            <p>{text}</p>
          </div>
        </article>
      ))}
    </section>
  );
}

export function ServicesGrid({ compact = false }: { compact?: boolean }) {
  return (
    <section className={compact ? "section compact" : "section"}>
      <div className="section-heading">
        <p className="eyebrow">Our Services</p>
        <h2>Our Appliance Repair Services</h2>
        <p>Professional repair and maintenance services for essential home appliances.</p>
      </div>
      <div className="service-grid">
        {services.map((service) => (
          <article className="service-card" key={service.href}>
            <Image src={service.image} alt="" width={126} height={144} />
            <div>
              <h3>{service.title}</h3>
              <p>{service.items.join(" • ")}</p>
              <Link className="btn btn-call small" href={service.href}>
                View Service
              </Link>
            </div>
          </article>
        ))}
      </div>
    </section>
  );
}

export function AboutPreview() {
  return (
    <section className="split-section">
      <div>
        <p className="eyebrow">About Prime Appliance Care</p>
        <h2>Reliable appliance repair focused on helping homes run smoothly.</h2>
        <p>
          Prime Appliance Care is a trusted local service provider specializing
          in washing machine and refrigerator repairs. We bring practical
          diagnosis, genuine repair parts, and customer-first support.
        </p>
        <ul className="check-list">
          <li>Experienced and certified technicians</li>
          <li>Genuine spare parts</li>
          <li>Transparent pricing</li>
          <li>Customer satisfaction is our priority</li>
        </ul>
      </div>
      <div className="photo-panel">
        <Image src="/images/about-technician.png" alt="Technician servicing a refrigerator" fill sizes="(max-width: 760px) 100vw, 44vw" />
      </div>
    </section>
  );
}

export function WhyChoose() {
  const points = ["Skilled Technicians", "Transparent Pricing", "Doorstep Service", "Quality Repair"];

  return (
    <section className="section soft">
      <div className="section-heading">
        <h2>Why Choose Us</h2>
      </div>
      <div className="value-grid">
        {points.map((point) => (
          <article key={point}>
            <span className="line-icon">◆</span>
            <h3>{point}</h3>
          </article>
        ))}
      </div>
    </section>
  );
}

export function Faqs() {
  return (
    <section className="section">
      <div className="section-heading">
        <h2>FAQs</h2>
      </div>
      <div className="faq-list">
        {faqs.map(([question, answer]) => (
          <details key={question}>
            <summary>{question}</summary>
            <p>{answer}</p>
          </details>
        ))}
      </div>
    </section>
  );
}

export function ServiceDetail({
  appliance,
  description,
  image,
  serviceTypes,
  seoSection,
  problems,
}: {
  appliance: string;
  description: string;
  image: string;
  serviceTypes: string[];
  seoSection?: {
    heading: string;
    paragraphs: string[];
    bullets: string[];
  };
  problems: string[];
}) {
  const steps = ["Book", "Inspect", "Diagnose", "Repair", "Test"];

  return (
    <>
      <section className="service-hero">
        <div>
          <p className="eyebrow">{appliance} Service</p>
          <h1>{appliance} Repair Service</h1>
          <p>{description}</p>
          <div className="button-row">
            <Link className="btn btn-call" href="/contact">
              Book Service
            </Link>
            <a className="btn btn-whatsapp" href={contact.whatsappHref}>
              WhatsApp Us
            </a>
          </div>
        </div>
        <div className="service-hero-image">
          <Image src={image} alt={`${appliance} repair service`} fill sizes="(max-width: 760px) 100vw, 44vw" />
        </div>
      </section>
      {seoSection ? (
        <section className="section seo-service-copy">
          <div className="section-heading">
            <h2>{seoSection.heading}</h2>
          </div>
          <div className="seo-copy-grid">
            <div>
              {seoSection.paragraphs.map((paragraph) => (
                <p key={paragraph}>{paragraph}</p>
              ))}
            </div>
            <ul className="check-list">
              {seoSection.bullets.map((bullet) => (
                <li key={bullet}>{bullet}</li>
              ))}
            </ul>
          </div>
        </section>
      ) : null}
      <section className="section two-col">
        <div>
          <h2>We Service</h2>
          <div className="mini-grid">
            {serviceTypes.map((item) => (
              <span key={item}>{item}</span>
            ))}
          </div>
        </div>
        <div>
          <h2>Common Problems We Fix</h2>
          <ul className="check-list columns">
            {problems.map((problem) => (
              <li key={problem}>{problem}</li>
            ))}
          </ul>
        </div>
      </section>
      <section className="section soft">
        <div className="section-heading">
          <h2>Our Repair Process</h2>
        </div>
        <div className="process-row">
          {steps.map((step, index) => (
            <article key={step}>
              <span>{index + 1}</span>
              <h3>{step}</h3>
            </article>
          ))}
        </div>
      </section>
      <WhyChoose />
      <Faqs />
      <section className="cta-band">
        <div>
          <h2>Need {appliance} Repair?</h2>
          <p>Get your appliance fixed fast with transparent service.</p>
        </div>
        <Link className="btn btn-whatsapp" href="/contact">
          Book a Service
        </Link>
      </section>
    </>
  );
}

export function ContactContent() {
  return (
    <main>
      <section className="page-title contact-title">
        <div>
          <p className="eyebrow">Need Appliance Repair?</p>
          <h1>We&apos;re Here to Help.</h1>
        </div>
      </section>
      <section className="contact-layout">
        <aside className="contact-info">
          <h2>Contact Information</h2>
          <a href={contact.phoneHref}>Call Us<br />{contact.phone}</a>
          <a href={contact.whatsappHref}>WhatsApp<br />Get instant support</a>
          <span>Service Area<br />{contact.location}</span>
          <span>Email<br />{contact.email}</span>
        </aside>
        <ContactForm />
      </section>
    </main>
  );
}
