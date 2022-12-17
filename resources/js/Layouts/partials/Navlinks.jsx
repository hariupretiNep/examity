import React from 'react'
import NavLink from '@/Components/NavLink';

export default function Navlinks() {
    return (
    <div className="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <NavLink href={route('dashboard')} active={route().current('dashboard')}>
    Dashboard
    </NavLink>
    <NavLink href={route('questionnaire')} active={route().current('questionnaire')}>
    Questionnaire
    </NavLink>
    </div>
    )
}
