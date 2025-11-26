// components/ui/toaster.tsx
"use client";

import * as React from "react";
import { useToast } from "@/hooks/use-toast";
import { Toast } from "./toast";

export const Toaster = () => {
  const { toasts, dismiss } = useToast();

  return (
    <>
      {toasts.map((t) => (
        <Toast
          key={t.id}
          id={t.id}
          open={t.open ?? true}
          title={t.title}
          description={t.description}
          onOpenChange={(open) => {
            if (!open) dismiss(t.id);
          }}
        />
      ))}
    </>
  );
};
