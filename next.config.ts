import type { NextConfig } from "next";

const siteUrl = process.env.NEXT_PUBLIC_SITE_URL?.trim().replace(/\/+$/, "");
const productionAssetPrefix =
  process.env.NODE_ENV === "production" && siteUrl ? siteUrl : undefined;

const nextConfig: NextConfig = {
  assetPrefix: productionAssetPrefix,
  output: "export",
  trailingSlash: true,
  images: {
    unoptimized: true,
  },
};

export default nextConfig;
