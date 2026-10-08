"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useEffect, useState } from "react";
import { contact } from "@/lib/site-data";

const nav = [
  ["Home", "/"],
  ["About", "/about"],
  ["Services", "/services"],
  ["Washing Machine Repair", "/washing-machine-repair"],
  ["Refrigerator Repair", "/refrigerator-repair"],
  ["Contact Us", "/contact"],
];

const desktopNav = nav.filter(([label]) =>
  ["Home", "About", "Services", "Contact Us"].includes(label),
);

export function SiteHeader() {
  const pathname = usePathname();
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  useEffect(() => {
    setIsMenuOpen(false);
  }, [pathname]);

  return (
    <>
      <header className="site-header">
        <Link className="brand" href="/" aria-label="Prime Appliance Care home">
          <span className="brand-mark">P</span>
          <span>
            <strong>Prime</strong>
            <small>Appliance Care</small>
          </span>
        </Link>
        <nav className="desktop-nav" aria-label="Primary navigation">
          {desktopNav.map(([label, href]) => (
            <Link className={pathname === href ? "active" : ""} href={href} key={href}>
              {label}
            </Link>
          ))}
        </nav>
        <div className="header-actions">
          <a className="btn btn-whatsapp" href={contact.whatsappHref}>
            WhatsApp Us
          </a>
          <a className="btn btn-call" href={contact.phoneHref}>
            Call Now
          </a>
        </div>
        <button
          aria-controls="mobile-navigation"
          aria-expanded={isMenuOpen}
          aria-label={isMenuOpen ? "Close menu" : "Open menu"}
          className={`mobile-menu ${isMenuOpen ? "open" : ""}`}
          onClick={() => setIsMenuOpen((open) => !open)}
          type="button"
        >
          <span />
          <span />
          <span />
        </button>
      </header>
      <div
        className={`menu-backdrop ${isMenuOpen ? "show" : ""}`}
        onClick={() => setIsMenuOpen(false)}
      />
      <aside
        aria-hidden={!isMenuOpen}
        className={`mobile-drawer ${isMenuOpen ? "show" : ""}`}
        id="mobile-navigation"
      >
        <div className="mobile-drawer-top">
          <div className="brand">
            <span className="brand-mark">P</span>
            <span>
              <strong>Prime</strong>
              <small>Appliance Care</small>
            </span>
          </div>
          <button
            aria-label="Close menu"
            className="drawer-close"
            onClick={() => setIsMenuOpen(false)}
            type="button"
          >
            ×
          </button>
        </div>
        <nav className="mobile-nav" aria-label="Mobile navigation">
          {nav.map(([label, href]) => (
            <Link className={pathname === href ? "active" : ""} href={href} key={href}>
              {label}
            </Link>
          ))}
        </nav>
        <div className="drawer-actions">
          <a className="btn btn-whatsapp" href={contact.whatsappHref}>
            WhatsApp Us
          </a>
          <a className="btn btn-call" href={contact.phoneHref}>
            Call Now
          </a>
        </div>
      </aside>
    </>
  );
}
