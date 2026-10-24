"use client";

import { contact } from "@/lib/site-data";
import { openCallModal } from "@/components/call-modal";

export function MobileActions() {
  return (
    <div className="mobile-actions">
      <button onClick={openCallModal} type="button">Call Now</button>
      <a href={contact.whatsappHref}>WhatsApp</a>
      <a href="/contact">Book Now</a>
    </div>
  );
}
