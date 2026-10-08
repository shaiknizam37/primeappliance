import { contact } from "@/lib/site-data";

export function MobileActions() {
  return (
    <div className="mobile-actions">
      <a href={contact.phoneHref}>Call Now</a>
      <a href={contact.whatsappHref}>WhatsApp</a>
      <a href="/contact">Book Now</a>
    </div>
  );
}
