import { Link } from "@tanstack/react-router";

function NavBar() {
    return ( 
        <nav className="p-4 flex gap-4 bg-gray-200 justify-between">
            <div className="flex gap-8">
                <Link to="/" className="[&.active]:font-bold text-blue-500">
                    Home
                </Link>
                <Link to="/sobre" className="[&.active]:font-bold text-blue-500">
                    Sobre
                </Link>
            </div>

            <div>
                <Link to="/login" className="text-blue-500">
                    Login
                </Link>
            </div>
        </nav>
    );
}

export default NavBar;