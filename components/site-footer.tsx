import Link from "next/link";
import { contact, services } from "@/lib/site-data";

export function SiteFooter() {
  return (
    <footer className="footer">
      <div className="footer-grid">
        <div>
          <div className="brand footer-brand">
            <span className="brand-mark">P</span>
            <span>
              <strong>Prime</strong>
              <small>Appliance Care</small>
            </span>
          </div>
          <p>Professional washing machine and refrigerator repair services.</p>
        </div>
        <div>
          <h3>Quick Links</h3>
          <Link href="/">Home</Link>
          <Link href="/about">About</Link>
          <Link href="/services">Services</Link>
          <Link href="/contact">Contact Us</Link>
        </div>
        <div>
          <h3>Services</h3>
          {services.map((service) => (
            <Link href={service.href} key={service.href}>
              {service.title}
            </Link>
          ))}
        </div>
        <div>
          <h3>Contact</h3>
          <a href={contact.phoneHref}>{contact.phone}</a>
          <a href={contact.whatsappHref}>WhatsApp</a>
          <a href={`mailto:${contact.email}`}>{contact.email}</a>
          <span>{contact.location}</span>
        </div>
      </div>
      <p className="copyright">© 2026 Prime Appliance Care. All rights reserved.</p>
    </footer>
  );
}
