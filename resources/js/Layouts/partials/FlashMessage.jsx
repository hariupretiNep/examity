import React, { useState } from 'react'

export default function FlashMessage({successMessage,FailedMessage}) {
    const [showFlashMessage,setShowFlashMessage] = useState(true);

    const hideFlahsMessage = () => {
        setShowFlashMessage(false);
    }

    return (
        <>
        {(successMessage && successMessage != "" && showFlashMessage) && <div className='max-w-7xl mt-4 mx-auto'>
        <div className='mx-8 p-2 bg-green-200 rounded-md border border-green-600 grid grid-flow-col grid-cols-12'>
        <div className='col-span-11'>{successMessage}</div>
        <div className='text-right'><span onClick={ () => hideFlahsMessage()} className='font-bold text-sm p-1 rounded-full bg-green-500 hover:bg-green-700 cursor-pointer'>x</span></div>
        </div>
        </div>}
        {(FailedMessage && FailedMessage != "" && showFlashMessage) && <div className='max-w-7xl mt-4 mx-auto'>
        <div className='mx-8 p-2 bg-red-200 rounded-md border border-red-600 grid grid-flow-col grid-cols-12'>
        <div className='col-span-11'>{FailedMessage}</div>
        <div className='text-right'><span onClick={ () => hideFlahsMessage()} className='font-bold text-sm p-1 rounded-full bg-red-500 hover:bg-red-700 cursor-pointer'>x</span></div>
        </div>
        </div>}
        </>
    )
}
