import { siteUrl } from "@/lib/env";

const businessName = process.env.NEXT_PUBLIC_BUSINESS_NAME || "Prime Appliance Care";
const phone = process.env.NEXT_PUBLIC_PHONE_NUMBER || "+91 8197869926";
const whatsappNumber = process.env.NEXT_PUBLIC_WHATSAPP_NUMBER || "+91 8197869926";
const email = process.env.NEXT_PUBLIC_EMAIL || "shouibm44@gmail.com";
const location = process.env.NEXT_PUBLIC_SERVICE_AREA || "Bangalore, Karnataka";


const digitsOnly = (value: string) => value.replace(/\D/g, "");

export const contact = {
  siteUrl,
  businessName,
  phone,
  phoneHref: `tel:+${digitsOnly(phone)}`,
  whatsappNumber,
  whatsappDigits: digitsOnly(whatsappNumber),
  whatsappHref: `https://wa.me/${digitsOnly(whatsappNumber)}`,
  email,
  location,
};

export const services = [
  {
    title: "Washing Machine Repair",
    href: "/washing-machine-repair",
    image: "/images/washer-card.png",
    items: ["Front Load", "Top Load", "Semi Automatic"],
  },
  {
    title: "Refrigerator Repair",
    href: "/refrigerator-repair",
    image: "/images/fridge-card.png",
    items: ["Single Door", "Double Door", "Side-by-Side"],
  },
];

export const trustPoints = [
  ["Experienced Technicians", "Skilled and trained professionals"],
  ["Doorstep Service", "At your convenience"],
  ["Transparent Pricing", "No hidden charges"],
  ["Reliable Repairs", "Quality service guaranteed"],
];

export const faqs = [
  ["Why is my washing machine not starting?", "It may be a power, door-lock, motor, or control board issue. Our technician diagnoses the cause before quoting repairs."],
  ["Why is my appliance making unusual noise?", "Noise often comes from worn bearings, loose mounts, blocked fans, or an uneven appliance position."],
  ["Can you repair both old and new appliance models?", "Yes. We service common front load, top load, semi automatic, single door, double door, and side-by-side models."],
  ["Do you provide doorstep repair?", "Yes. Prime Appliance Care provides doorstep inspection and repair service across Bangalore service areas."],
];
