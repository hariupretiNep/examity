import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import FlashMessage from '@/Layouts/partials/FlashMessage';
import { Head, Link } from '@inertiajs/inertia-react';
import { useState } from 'react';
import {GrFormAdd} from 'react-icons/gr';

export default function List(props) {
    const [activeQuestionnaires,setActiveQuestionnaires] = useState(props.activeQuestionnaires??[]);
    const listStyle = "bg-white/50 border-1 border-gray-800 shadow-sm w-full p-2 rounded-sm cursor-pointer hover:border-slate-900 hover:bg-white mt-2";
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
            <FlashMessage successMessage={props.message.success??""} FailedMessage={props.message.failed??""}></FlashMessage>
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h3 className='text-gray-600 mb-6'>Active Questionnaire</h3>
                    <ul>
                        {
                            activeQuestionnaires && activeQuestionnaires.map((eachQuestionnaire,index) => {
                            return <li key={index} className={listStyle}>
                                <div className='grid grid-flow-col grid-cols-2'>
                                <div className='text-lg font-bold'>{eachQuestionnaire['title']}</div>
                                <div className='text-right text-xs mt-6'>
                                Expire On: {eachQuestionnaire['expiry_date']}
                                </div>
                                </div>
                            </li>
                            })
                        }
                    </ul>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
