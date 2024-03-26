import { useState } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import { Link as RouterLink, Head } from "@inertiajs/react";
import { usePage } from '@inertiajs/react'

export default function Authenticated({ user, header, children }) {
  const { props } = usePage();

  return (
    <div className="min-h-screen bg-gray-100 dark:bg-gray-90
