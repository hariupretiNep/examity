import PrimaryButton from '@/Components/PrimaryButton';
import ExamLayout from '@/Layouts/ExamLayout';
import FlashMessage from '@/Layouts/partials/FlashMessage';
import { Head, Link } from '@inertiajs/inertia-react';
import { useState } from 'react';
import {GrFormAdd} from 'react-icons/gr';

export default function Start(props) {
    const [testDetails,setTestDetails] = useState(props.questionnaire??[]);
    const [allQuestions,setQuestions] = useState(props.questions??[]);
    const [testBegin,setTestBegin] = useState(false);


    const startTest = () => {
        setTestBegin(true);
    }

    return (
        <ExamLayout>
            <Head title="Accept Invitation" />
            <FlashMessage successMessage={props.message.success??""} FailedMessage={props.message.failed??""}></FlashMessage>
            {
                testDetails && !testBegin &&
                <div className="p-12">
                    <h2 className='text-center text-lg font-bold'>Welcome to Examity</h2>
                    <div>
                        Hi <span className='font-bold'>{testDetails.student.name},</span>
                        <div className='indent-12 mt-3'>Thank you for accepting the invitation and participating on this test. Below, you will find the details regarding this test and you can start this test anytime but before it's expiry date. Once you start your test you have to complete your test in a single attempt, this test will not available to you multiple time.</div>
                    </div>
                    <div className='mt-10 border border-gray-400 rounded-md p-10 shadow-lg'>
                        <div className='grid grid-flow-col grid-cols-10'>
                            <div className='col-span-8'>
                                <div className='text-lg font-bold'>{testDetails.questionnaire.title}</div>
                                <div className='text-xs font-semibold'>Expired On: {testDetails.questionnaire.expiry_date}</div>
                            </div>
                            <div className='col-span-2 text-right'>
                                <PrimaryButton onClick={() => startTest()}>Start Now</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            }
        </ExamLayout>
    );
}
