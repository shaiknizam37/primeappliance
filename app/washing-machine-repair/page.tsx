import { ServiceDetail } from "@/components/sections";

export default function WashingMachineRepairPage() {
  return (
    <main>
      <ServiceDetail
        appliance="Washing Machine"
        description="Professional washing machine repair service for common washing machine problems, backed by doorstep inspection and careful testing."
        image="/images/washer-service.png"
        serviceTypes={["Front Load", "Top Load", "Semi Automatic"]}
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
