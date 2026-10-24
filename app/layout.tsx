import type { Metadata } from "next";
import "./globals.css";
import { SiteFooter } from "@/components/site-footer";
import { SiteHeader } from "@/components/site-header";
import { MobileActions } from "@/components/mobile-actions";
import { CallModal } from "@/components/call-modal";
import { siteUrl } from "@/lib/env";

export const metadata: Metadata = {
  metadataBase: siteUrl ? new URL(siteUrl) : undefined,
  title: "Prime Appliance Care | Appliance Repair in Bangalore",
  description:
    "Professional washing machine and refrigerator repair services with transparent pricing and doorstep support in Bangalore.",
  alternates: {
    canonical: "/",
  },
  openGraph: {
    title: "Prime Appliance Care | Appliance Repair in Bangalore",
    description:
      "Professional washing machine and refrigerator repair services with transparent pricing and doorstep support in Bangalore.",
    url: "/",
    siteName: "Prime Appliance Care",
    type: "website",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body>
        <SiteHeader />
        {children}
        <SiteFooter />
        <MobileActions />
        <CallModal />
      </body>
    </html>
  );
}
