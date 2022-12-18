import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/inertia-react';

export default function Exam({ children }) {
    return (
        <div className="min-h-screen w-full bg-gray-600">
            <div className='container mx-auto rounded-none bg-gray-600 pt-24'>
                <Link href="/" className='rounded-none w-fit'>
                    <ApplicationLogo className="w-20 h-20 fill-current text-gray-500 rounded-none" />
                </Link>
                <div className="container bg-white rounded-b-md">
                {children}
                </div>
            </div>
        </div>
    );
}
