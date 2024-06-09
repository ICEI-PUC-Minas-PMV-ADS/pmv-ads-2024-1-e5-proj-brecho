
# Casos de Teste de Software

| **Caso de Teste** | **Descrição** | **Passos** | **Resultado Esperado** | **Captura de Tela** |
|-------------------|---------------|------------|-------------------------|---------------------|
| Abertura do Programa | Verificar se o programa abre corretamente. | 1. Abrir o programa. | O programa é aberto com sucesso. | ![01-TelaPrincipal](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/1f23787a-89c2-4465-9b8f-72eaa1497138) |
| Login | Verificar se o login funciona conforme esperado. | 1. Abrir o programa. <br> 2. Selecionar a opção de fazer login. <br> 3. Inserir credenciais válidas. <br> 4. Confirmar o login. | O login é realizado com sucesso e a opção de cadastrar novo usuário está disponível. | ![02-TelaLogin](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/8dc39724-dee9-4ae1-b2d5-944060317ac3) ![03-TelaLoginSenha](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/6cc7ea3b-ef6e-4a7a-92c2-44c8463d551d) ![04-TelaAutenticaçãoSenha](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/76507379-bcbc-48ca-a236-3e8ece3f76f3) ![06-TelaCadastroPreencher](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/323fcc57-a9e1-489d-9efb-588985238cd6) |
| Tela de Produtos Disponíveis | Verificar se a tela de produtos disponíveis é acessível. | 1. Abrir o programa. <br> 2. Realizar o login, se necessário. <br> 3. Navegar até a tela de produtos disponíveis. | A tela de produtos disponíveis é acessada sem problemas. | ![07-TelaCadastrada](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/950b1ad2-fc96-46ec-8ec8-a3c9bf62868f) ![01-02-TelaPrincipal](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/d56c6d21-f046-4269-ae3a-4b954bd28faa) |
| Tela de Carrinho de Compras | Verificar se a tela de carrinho de compras é acessível. | 1. Abrir o programa. <br> 2. Realizar o login, se necessário. <br> 3. Navegar até a tela de carrinho de compras. | A tela de carrinho de compras é acessada e exibe os produtos corretamente. | ![08-TelaProdutos](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/dfa852de-c1bf-4e61-a156-7815da009ffc) |
| Botão Sair | Verificar se o botão de sair funciona corretamente. | 1. Abrir o programa. <br> 2. Realizar o login, se necessário. <br> 3. Localizar e clicar no botão de sair. | O programa é fechado sem problemas. |![09-TelaBotaoSair](https://github.com/ICEI-PUC-Minas-PMV-ADS/pmv-ads-2024-1-e5-proj-empext-t1-pmv-ads-2024-1-e3-proj-brecho/assets/103541634/c1e6e719-2d2b-4c24-9f02-9f7763b1369d)|


# Plano de Teste (Marcos Vidal)

## Objetivo
Verificar a funcionalidade e a usabilidade das telas de login, produtos e pesquisa no sistema. Garantir que todas as funcionalidades principais estejam operando conforme o esperado.

## Escopo
- Tela de Login
- Tela de Produtos
- Tela de Pesquisa

## Resultado do Último Teste
- Tela de login está funcionando.
- Tela de produtos está funcionando.
- Tela de pesquisa, está pesquisando para produto, para o tipo de produto não está funcionando, para categoria não está funcionando.

## Itens de Teste

### Tela de Login
- [ ] Verificar se a tela de login carrega corretamente.
- [ ] Testar o processo de login com credenciais válidas.
- [ ] Testar o processo de login com credenciais inválidas.
- [ ] Verificar mensagens de erro ao inserir dados incorretos.
- [ ] Testar a funcionalidade de "Esqueci minha senha".

### Tela de Produtos
- [ ] Verificar se a tela de produtos carrega corretamente.
- [ ] Garantir que todos os produtos sejam exibidos corretamente.
- [ ] Verificar a exibição de detalhes de um produto específico.
- [ ] Testar a adição de produtos ao carrinho de compras.
- [ ] Testar a remoção de produtos do carrinho de compras.

### Tela de Pesquisa
- [ ] Verificar se a tela de pesquisa carrega corretamente.
- [x] Testar a funcionalidade de pesquisa por nome de produto (funcionando).
- [ ] Testar a funcionalidade de pesquisa por tipo de produto (não funcionando).
  - **Ação necessária:** Investigar e corrigir a falha na pesquisa por tipo de produto.
- [ ] Testar a funcionalidade de pesquisa por categoria (não funcionando).
  - **Ação necessária:** Investigar e corrigir a falha na pesquisa por categoria.

## Critérios de Sucesso
- Todas as funcionalidades devem operar sem erros.
- Mensagens de erro devem ser claras e informativas.
- O usuário deve ser capaz de realizar todas as operações esperadas (login, visualização de produtos, pesquisa) sem encontrar falhas.

## Estratégia de Teste
- **Teste Funcional:** Verificar se todas as funcionalidades especificadas estão operando conforme o esperado.
- **Teste de Interface do Usuário (UI):** Garantir que a interface do usuário seja intuitiva e responsiva.
- **Teste de Regressão:** Executar testes para garantir que novas alterações não introduzam novos bugs em funcionalidades que já estavam funcionando.
- **Teste de Desempenho:** Verificar o tempo de carregamento das páginas e a resposta do sistema sob diferentes cargas.

## Cronograma
- **Semana 1:**
  - Revisão do plano de teste.
  - Configuração do ambiente de teste.
  - Criação de scripts de teste automatizados para a tela de login e produtos.
- **Semana 2:**
  - Execução de testes na tela de login e produtos.
  - Relatório de bugs encontrados.
- **Semana 3:**
  - Investigação e correção dos problemas na tela de pesquisa.
  - Criação de scripts de teste para a tela de pesquisa.
- **Semana 4:**
  - Execução de testes na tela de pesquisa.
  - Relatório final e fechamento de bugs.

## Equipe de Teste
- **Testador 1:** Focado na tela de login e produtos.
- **Testador 2:** Focado na tela de pesquisa.
- **Desenvolvedor:** Para suporte na correção de bugs identificados.

## Riscos
- Possíveis atrasos na correção de bugs.
- Inconsistências entre diferentes navegadores e dispositivos.

## Mitigações
- Estabelecer comunicação eficiente entre testadores e desenvolvedores.
- Planejar tempo extra no cronograma para lidar com atrasos inesperados.

## Relatório de Teste
Após a execução dos testes, um relatório detalhado será gerado contendo:
- Resumo dos testes realizados.
- Lista de bugs encontrados.
- Status de cada item de teste.
- Recomendações para melhorias futuras.
