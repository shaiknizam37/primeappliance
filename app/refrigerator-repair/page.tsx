import { ServiceDetail } from "@/components/sections";

export default function RefrigeratorRepairPage() {
  return (
    <main>
      <ServiceDetail
        appliance="Refrigerator"
        description="Reliable refrigerator repair service for cooling problems, freezer issues, leaks, compressor concerns, and regular home appliance breakdowns."
        image="/images/fridge-service.png"
        serviceTypes={["Single Door", "Double Door", "Side-by-Side", "Freezer"]}
        problems={[
          "Refrigerator not cooling",
          "Freezer not freezing",
          "Water leakage",
          "Unusual noise",
          "Compressor problems",
          "Refrigerator not starting",
        ]}
      />
    </main>
  );
}
