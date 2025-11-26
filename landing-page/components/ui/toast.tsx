"use client";

import * as React from "react";
import { X } from "lucide-react";
import { cn } from "@/lib/utils";

export interface ToastProps {
  id: string;
  open: boolean;
  title?: React.ReactNode;
  description?: React.ReactNode;
  onOpenChange?: (open: boolean) => void;
}

export const Toast = ({ id, open, title, description, onOpenChange }: ToastProps) => {
  if (!open) return null;

  return (
    <div
      className={cn(
        "fixed bottom-4 right-4 w-80 bg-white border border-gray-200 shadow-lg rounded-lg p-4 animate-slide-in z-50"
      )}
    >
      <div className="flex justify-between items-start">
        <div className="space-y-1">
          {title && <p className="font-bold text-gray-900">{title}</p>}
          {description && <p className="text-sm text-gray-700">{description}</p>}
        </div>
        <button
          className="text-gray-400 hover:text-gray-600"
          onClick={() => onOpenChange?.(false)}
        >
          <X size={16} />
        </button>
      </div>
    </div>
  );
};
