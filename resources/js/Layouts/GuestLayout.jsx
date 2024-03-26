import ApplicationLogo from "@/Components/ApplicationLogo"; // Importing the ApplicationLogo component
import { Link } from "@inertiajs/react"; // Importing the Link component from Inertia.js

// Defining a default export function named "Guest" that takes a "children" argument
export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            {/* Rendering the ApplicationLogo component */}
            <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
            {/* Rendering a Link component that will navigate to the login page */}
            <Link
                href={route("login")}
                className="w-full mt-6 font-semibold text-xl text-gray-800 bg-gray-300 hover:bg-gray-400 focus:outline-none focus:shadow-outline-blue active:bg-gray-500 uppercase tracking-wider"
            >
                Login
            </Link>
            {/* Rendering the "children" prop, which can contain any additional elements that the parent component wants to include */}
            {children}
        </div>
    );
}
