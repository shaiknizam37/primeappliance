export function normalizeSiteUrl(value?: string) {
  if (!value) {
    return "";
  }

  return value.trim().replace(/\/+$/, "");
}

export const siteUrl = normalizeSiteUrl(process.env.NEXT_PUBLIC_SITE_URL);
