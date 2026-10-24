"use client";

import { useEffect, useRef, useState } from "react";
import { usePathname } from "next/navigation";
import { contact } from "@/lib/site-data";

export const CALL_MODAL_EVENT = "prime-appliance-care:open-call-modal";

export function openCallModal() {
  window.dispatchEvent(new CustomEvent(CALL_MODAL_EVENT));
}

export function CallModal() {
  const pathname = usePathname();
  const [isOpen, setIsOpen] = useState(false);
  const previousPathname = useRef<string | null>(null);

  useEffect(() => {
    if (previousPathname.current !== null && previousPathname.current !== pathname) {
      setIsOpen(true);
    }

    previousPathname.current = pathname;
  }, [pathname]);

  useEffect(() => {
    const handleOpen = () => setIsOpen(true);
    window.addEventListener(CALL_MODAL_EVENT, handleOpen);

    return () => window.removeEventListener(CALL_MODAL_EVENT, handleOpen);
  }, []);

  useEffect(() => {
    if (!isOpen) {
      return;
    }

    const handleKeyDown = (event: KeyboardEvent) => {
      if (event.key === "Escape") {
        setIsOpen(false);
      }
    };

    document.body.classList.add("modal-open");
    document.addEventListener("keydown", handleKeyDown);

    return () => {
      document.body.classList.remove("modal-open");
      document.removeEventListener("keydown", handleKeyDown);
    };
  }, [isOpen]);

  if (!isOpen) {
    return null;
  }

  return (
    <div
      aria-labelledby="call-modal-title"
      aria-modal="true"
      className="call-modal-backdrop"
      onClick={() => setIsOpen(false)}
      role="dialog"
    >
      <div className="call-modal" onClick={(event) => event.stopPropagation()}>
        <button
          aria-label="Close call options"
          className="call-modal-close"
          onClick={() => setIsOpen(false)}
          type="button"
        >
          <span aria-hidden="true">×</span>
        </button>
        <div className="call-modal-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z" />
          </svg>
        </div>
        <p className="eyebrow">Need appliance help?</p>
        <h2 id="call-modal-title">Talk to Prime Appliance Care</h2>
        <p className="call-modal-copy">
          Call our team and we&apos;ll help arrange a convenient doorstep service.
        </p>
        <a className="call-modal-action" href={contact.phoneHref}>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z" />
          </svg>
          Call {contact.phone}
        </a>
      </div>
    </div>
  );
}
