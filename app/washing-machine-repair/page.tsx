import type { Metadata } from "next";
import { ServiceDetail } from "@/components/sections";

export const metadata: Metadata = {
  title: "Washing Machine Repair Bangalore | Home Service",
  description:
    "Book washing machine repair and servicing at home in Bangalore. Our technicians repair Bosch, IFB, Samsung and other front load, top load and semi-automatic machines.",
  keywords: [
    "washing machine servicing",
    "washing machine technician",
    "Bosch washing machine repair service",
    "washing machine repair home service near me",
    "washing machine service center near me",
    "washing machine technician near me",
    "washing machine service repair Bengaluru",
    "washing machine repair service at home",
    "IFB washing machine repair service",
    "washing machine repair near me",
    "washing machine service repair Bangalore",
    "washing machine fixer",
    "Samsung washing machine repair service",
    "front load washing machine repair near me",
  ],
  alternates: {
    canonical: "/washing-machine-repair/",
  },
  openGraph: {
    title: "Washing Machine Repair Bangalore | Home Service",
    description:
      "Reliable washing machine repair, servicing and doorstep technician support for homes across Bangalore.",
    url: "/washing-machine-repair/",
    type: "website",
  },
};

export default function WashingMachineRepairPage() {
  return (
    <main>
      <ServiceDetail
        appliance="Washing Machine"
        description="Reliable washing machine repair service at home in Bangalore, with doorstep inspection, transparent pricing and careful testing by experienced technicians."
        image="/images/washer-service.png"
        serviceTypes={["Front Load", "Top Load", "Semi Automatic"]}
        seoSection={{
          heading: "Washing Machine Servicing at Home in Bangalore",
          paragraphs: [
            "Looking for washing machine repair near me, a washing machine technician near me or a trusted washing machine service center near me? Prime Appliance Care provides convenient washing machine servicing and repair home service across Bengaluru and Bangalore.",
            "Our washing machine fixer handles front load, top load and semi-automatic machines. We provide Bosch washing machine repair service, IFB washing machine repair service and Samsung washing machine repair service, along with support for other popular brands.",
          ],
          bullets: [
            "Front load washing machine repair and drum, door-lock and drainage issues",
            "Washing machine not starting, not spinning, leaking or making unusual noise",
            "Home inspection by an experienced washing machine technician",
            "Clear diagnosis, genuine parts and transparent repair pricing",
          ],
        }}
        problems={[
          "Washing machine not starting",
          "Not spinning",
          "Water not draining",
          "Excessive vibration",
          "Door not opening",
          "Water leakage",
        ]}
      />
    </main>
  );
}
