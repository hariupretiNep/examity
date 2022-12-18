import React, { useState } from "react";
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/inertia-react';
import {GrFormAdd} from 'react-icons/gr';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Add(props) {
    const { data, setData, post, processing, errors, reset } = useForm({
        title: '',
        expiry_date: new Date(),
    });

    const onHandleChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const createQuestionnaire = () => {
        post(route("createQuestionnaire"));
    }

    const onDateChange = (date) => {
        setData("expiry_date",date)
    }

    return (
            <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            header={
                <div className='grid grid-flow-col grid-cols-2'>
                    <div><h2 className="font-semibold text-xl text-gray-800 leading-tight">Questionnaire</h2></div>
                    <div className='text-right'>
                        <Link href={route('questionnaire')} className='bg-green-500 hover:bg-green-700 px-2 py-1 rounded-md text-white/90'> List</Link>
                    </div>
                </div>
            }
            >
            <Head title="Create New Questionnaire" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg px-10 py-10">
                        <div className='grid lg:grid-flow-col lg:grid-cols-3 sm:grid-flow-row'>
                            <div className="m-4">
                            <InputLabel forInput="title" value="Title" />
                            <TextInput
                            id="title"
                            type="title"
                            name="title"
                            value={data.title}
                            className="mt-1 block w-full border border-gray-300 focus-visible:outline-none p-1"
                            autoComplete="current-title"
                            handleChange={onHandleChange}
                            />
                            <InputError message={errors.title} className="mt-2" />
                            </div>
                            <div className="m-4">
                            <InputLabel forInput="expiryDate" value="Expiry Date" />
                            <DatePicker className="rounded-md p-1 mt-1" 
                            selected={data.expiry_date} 
                            onChange={(date) => onDateChange(date)}
                            minDate={new Date()}
                            showTimeSelect
                            timeFormat="p"
                            timeIntervals={15}
                            dateFormat="Pp"
                            isClearable
                            />
                            <InputError message={errors.expiry_date} className="mt-2" />
                            </div>
                            <div className="m-4 mt-8">
                                <PrimaryButton processing={processing} onClick={ () => createQuestionnaire() } className="bg-green-600 hover:bg-green-700 float-right normal-case">Generate Questionnaire</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
