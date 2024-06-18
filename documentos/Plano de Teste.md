# Plano de Teste

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
