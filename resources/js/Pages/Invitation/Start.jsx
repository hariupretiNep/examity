import PrimaryButton from '@/Components/PrimaryButton';
import ExamLayout from '@/Layouts/ExamLayout';
import FlashMessage from '@/Layouts/partials/FlashMessage';
import { Head, Link, useForm } from '@inertiajs/inertia-react';
import axios from 'axios';
import { useState } from 'react';

export default function Start(props) {
    const [questionnaireData,setQuestionnaireData] = useState(props.data??[]);
    const [questions,setQuestions] = useState([]);
    const [answers,setAnswers] = useState([]);
    const [start,setStart] = useState(false);
    const [load,setLoad] = useState(false);
    const [completed,setCompleted] = useState(false);
    const { data, setData, post, processing, errors, reset } = useForm({
        invitation_code: questionnaireData.invitation_code,
        student_id: questionnaireData.student.id,
        questionnaire_id: questionnaireData.questionnaire.id,
    });

    const startTest = () => {
        axios.post(route('startInvitationTest'),data).then((response) => {
            setQuestions(response.data.data);
            setStart(true);
        });
    }

    const selectAnswer = (questionId,answerId) => {
        const allAnswer = answers;
        const newAnswer = {"question_id":questionId,"answer_id":answerId,"student_id":data.student_id};
        const index = allAnswer.findIndex(object => object.question_id === newAnswer.question_id);
        if (index === -1) {
            allAnswer.push(newAnswer);
        }
        setAnswers(allAnswer);
        setLoad(!load);
        console.log(allAnswer);
    }

    const submitAnswer = () => {
        axios.post(route('submitInvitationTest'),{"answers":answers,"invitation_code":data.invitation_code}).then((response) => {
            if(response.data.success){
                setCompleted(true);
            }
        });
    }

    return (
        <ExamLayout>
            <Head title="Accept Invitation" />
            <FlashMessage successMessage={props.message.success??""} FailedMessage={props.message.failed??""}></FlashMessage>
            {
                questionnaireData && !start && !completed &&
                <div className="p-12">
                    <h2 className='text-center text-lg font-bold'>Welcome to Examity</h2>
                    <div>
                        Hi <span className='font-bold'>{questionnaireData.student.name},</span>
                        <div className='indent-12 mt-3'>Thank you for accepting the invitation and participating on this test. Below, you will find the details regarding this test and you can start this test anytime but before it's expiry date. Once you start your test you have to complete your test in a single attempt, this test will not available to you multiple time.</div>
                    </div>
                    <div className='mt-10 border border-gray-400 rounded-md p-10 shadow-lg'>
                        <div className='grid grid-flow-col grid-cols-10'>
                            <div className='col-span-8'>
                                <div className='text-lg font-bold'>{questionnaireData.questionnaire.title}</div>
                                <div className='text-xs font-semibold'>Expired On: {questionnaireData.questionnaire.expiry_date}</div>
                            </div>
                            <div className='col-span-2 text-right'>
                                <PrimaryButton onClick={() => startTest()}>Start Now</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            }
            {
                questions && start && !completed && Object.keys(questions).map((key,index) => {
                    return <div className="p-12" key={"parent"+index}>
                    <h2 className='text-lg font-bold'>{questions[key].question}</h2>
                    <div className='grid grid-flow-col'>
                        {
                            Object.keys(questions[key].options).map((innerkey,index) => {
                                return <div onClick={() => selectAnswer(questions[key].options[innerkey].question_id,questions[key].options[innerkey].id)} key={"inner"+index} 
                                className={`${answers.findIndex(eachAns => (eachAns.question_id === questions[key].options[innerkey].question_id && eachAns.answer_id === questions[key].options[innerkey].id)) != -1?"bg-blue-400 hover:bg-blue-500":"bg-slate-300"} border border-gray-400 p-4 rounded-md m-2 cursor-pointer bg-slate-100 hover:border-gray-600 hover:bg-slate-50`}>
                                {questions[key].options[innerkey].answer}</div>
                            })
                        }
                    </div>
                    </div>
                })
            }
            {
                questions && start && !completed && 
                <div className='w-full grid p-10 place-content-end'>
                    <PrimaryButton onClick={() => submitAnswer() }>Submit Answer</PrimaryButton>
                </div>
            }
            {
                completed && <div className='w-full text-center bg-white p-10 text-2xl font-bold text-green-600'>Your answers submitted successfully!!!</div>
            }
        </ExamLayout>
    );
}
