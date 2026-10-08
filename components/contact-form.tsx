"use client";

import { FormEvent, useMemo, useState } from "react";
import { contact } from "@/lib/site-data";

type FormValues = {
  name: string;
  mobile: string;
  appliance: string;
  address: string;
  details: string;
};

type FormErrors = Partial<Record<keyof FormValues, string>>;

const initialValues: FormValues = {
  name: "",
  mobile: "",
  appliance: "",
  address: "",
  details: "",
};

const mobileDigits = (value: string) => value.replace(/\D/g, "");

function validate(values: FormValues) {
  const errors: FormErrors = {};
  const digits = mobileDigits(values.mobile);

  if (values.name.trim().length < 2) {
    errors.name = "Enter your name.";
  }

  if (digits.length < 10 || digits.length > 15) {
    errors.mobile = "Enter a valid mobile number.";
  }

  if (!values.appliance) {
    errors.appliance = "Select an appliance.";
  }

  if (values.address.trim().length < 5) {
    errors.address = "Enter your service address.";
  }

  if (values.details.trim().length < 10) {
    errors.details = "Describe the problem in at least 10 characters.";
  }

  return errors;
}

export function ContactForm() {
  const [values, setValues] = useState<FormValues>(initialValues);
  const [errors, setErrors] = useState<FormErrors>({});
  const [submitted, setSubmitted] = useState(false);

  const hasErrors = useMemo(() => Object.keys(errors).length > 0, [errors]);

  function updateField(field: keyof FormValues, value: string) {
    setValues((current) => ({ ...current, [field]: value }));
    if (submitted) {
      setErrors(validate({ ...values, [field]: value }));
    }
  }

  function handleSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setSubmitted(true);

    const nextErrors = validate(values);
    setErrors(nextErrors);

    if (Object.keys(nextErrors).length > 0) {
      return;
    }

    const message = [
      `New service request for ${contact.businessName}`,
      "",
      `Name: ${values.name.trim()}`,
      `Mobile: ${values.mobile.trim()}`,
      `Appliance: ${values.appliance}`,
      `Address: ${values.address.trim()}`,
      `Problem: ${values.details.trim()}`,
    ].join("\n");

    window.open(
      `https://wa.me/${contact.whatsappDigits}?text=${encodeURIComponent(message)}`,
      "_blank",
      "noopener,noreferrer",
    );
  }

  return (
    <form className="request-card" noValidate onSubmit={handleSubmit}>
      <h2>Request a Service</h2>
      {submitted && hasErrors ? (
        <p className="form-status error">Please fix the highlighted fields.</p>
      ) : null}
      <label>
        Name
        <input
          aria-invalid={Boolean(errors.name)}
          onChange={(event) => updateField("name", event.target.value)}
          placeholder="Your name"
          type="text"
          value={values.name}
        />
        {errors.name ? <span className="field-error">{errors.name}</span> : null}
      </label>
      <label>
        Mobile Number
        <input
          aria-invalid={Boolean(errors.mobile)}
          onChange={(event) => updateField("mobile", event.target.value)}
          placeholder="+91 98765 43210"
          type="tel"
          value={values.mobile}
        />
        {errors.mobile ? <span className="field-error">{errors.mobile}</span> : null}
      </label>
      <label>
        Appliance
        <select
          aria-invalid={Boolean(errors.appliance)}
          onChange={(event) => updateField("appliance", event.target.value)}
          value={values.appliance}
        >
          <option value="" disabled>
            Select appliance
          </option>
          <option>Washing Machine</option>
          <option>Refrigerator</option>
        </select>
        {errors.appliance ? <span className="field-error">{errors.appliance}</span> : null}
      </label>
      <label>
        Address
        <input
          aria-invalid={Boolean(errors.address)}
          onChange={(event) => updateField("address", event.target.value)}
          placeholder="Service address"
          type="text"
          value={values.address}
        />
        {errors.address ? <span className="field-error">{errors.address}</span> : null}
      </label>
      <label>
        Problem Details
        <textarea
          aria-invalid={Boolean(errors.details)}
          onChange={(event) => updateField("details", event.target.value)}
          placeholder="Tell us what happened"
          value={values.details}
        />
        {errors.details ? <span className="field-error">{errors.details}</span> : null}
      </label>
      <button className="btn btn-whatsapp" type="submit">
        Request Service
      </button>
    </form>
  );
}
