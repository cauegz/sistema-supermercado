import React from 'react'
import { createRouter, createRoute, createRootRoute, Link, Outlet } from '@tanstack/react-router'
import LandingPage from './pages/LandingPage'
import LoginPage from './pages/LoginPage'
import NavBar from './components/NavBar'

//o que vai ficar em todas as páginas
const rootRoute = createRootRoute({
  component: () => (
    <>
      <NavBar />
      <div className="p-4">
        <Outlet />
      </div>
    </>
  ),
  // <Outlet /> - conteúdo das rotas  
})

// aqui se cria cada rota, onde cada uma renderiza uma coisa diferente e aqui que se define qual a rota de cada um
const home = createRoute({
  getParentRoute: () => rootRoute,
  path: '/',
  component: () => <LandingPage />,
})
const login = createRootRoute({
  getParentRoute: () => rootRoute,
  path: '/login',
  component: () => <LoginPage />
})

// pega as rotas filhas e junta em um lugar só
const routeTree = rootRoute.addChildren([home, login])

export const router = createRouter({ routeTree })