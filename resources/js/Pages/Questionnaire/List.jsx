import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/inertia-react';
import {GrFormAdd} from 'react-icons/gr';

export default function Dashboard(props) {
    return (
            <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            header={
                <div className='grid grid-flow-col grid-cols-2'>
                    <div><h2 className="font-semibold text-xl text-gray-800 leading-tight">Questionnaire</h2></div>
                    <div className='text-right'>
                        <Link href={route('addQuestionnaire')} className='bg-green-500 hover:bg-green-700 px-2 py-1 rounded-md text-white/90'> Add</Link>
                    </div>
                </div>
            }
            >
            <Head title="Active Questionnaire" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h3>Active Questionnaire</h3>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
