# API de Stories (Admin)

Documentação em Português para integrar o recurso de *Stories* de outro sistema.

Base URL (exemplo):
- https://seu-dominio.test/api/admin

Autenticação
- A API permite acesso de duas formas:
  1. Sessão autenticada (cookie) — útil quando o cliente reusa a sessão do painel `/admin`.
  2. Header `X-Admin-Token: <TOKEN>` — token estático configurado em `.env` como `EXTERNAL_ADMIN_TOKEN`.

Observações:
- O controller atual (`App\Http\Controllers\AdminApi\StoryApiController`) aceita `X-Admin-Token` exato (sem `Bearer`), ou uma sessão autenticada (auth()->check()).
- O campo `cover` não é aceito pela API pública atual; `cover` é gerenciado pelo painel Filament. Se precisar, posso adicionar suporte via API.
- A coluna `order` existe (nome reservado), use com cuidado; em alternativa escolha `sort_order` e atualize o código.

Formato das imagens
- O campo `images` é um array de strings. Recomenda-se enviar caminhos relativos ao storage público, por exemplo: `stories/arquivo.jpg`.
- No frontend do site, as imagens são geralmente servidas com `asset('storage/' . $path)` — portanto um item `stories/foo.jpg` resultará em `https://seu-dominio.test/storage/stories/foo.jpg`.
- Você também pode usar URLs completas (`https://.../stories/foo.jpg`) se preferir.

Endpoints

1) Listar Stories
- Método: GET
- URL: `/stories`
- Descrição: retorna todos os stories ordenados por `order`.
- Autenticação: session ou header `X-Admin-Token`.
- Exemplo curl:
```bash
curl -X GET "https://seu-dominio.test/api/admin/stories" -H "X-Admin-Token: SEU_TOKEN"
```
- Resposta (200):
```json
{
  "stories": [
    {
      "id": 1,
      "title": "Promoção",
      "images": ["stories/1.jpg","stories/2.jpg"],
      "order": 0,
      "active": 1,
      "cover": null,
      "created_at": "2025-12-19T12:00:00Z",
      "updated_at": "2025-12-19T12:00:00Z"
    }
  ]
}
```

2) Obter 1 Story
- Método: GET
- URL: `/stories/{id}`
- Resposta (200):
```json
{ "story": { /* objeto story */ } }
```
- Resposta de erro (404):
```json
{ "error": "not_found" }
```

3) Criar Story
- Método: POST
- URL: `/stories`
- Content-Type: `application/json`
- Body (exemplo):
```json
{
  "title": "Story nova",
  "images": ["stories/novo1.jpg","stories/novo2.jpg"],
  "order": 5,
  "active": true
}
```
- Exemplo curl:
```bash
curl -X POST "https://seu-dominio.test/api/admin/stories" \
  -H "Content-Type: application/json" \
  -H "X-Admin-Token: SEU_TOKEN" \
  -d '{"title":"Story nova","images":["stories/novo1.jpg"],"order":5,"active":true}'
```
- Resposta (201):
```json
{ "story": { "id": 10, "title": "Story nova", "images": ["stories/novo1.jpg"], "order": 5, "active": 1 } }
```

4) Atualizar Story
- Método: PUT
- URL: `/stories/{id}`
- Body: mesmo formato que `POST`. Campos ausentes permanecem.
- Exemplo curl:
```bash
curl -X PUT "https://seu-dominio.test/api/admin/stories/10" \
  -H "Content-Type: application/json" \
  -H "X-Admin-Token: SEU_TOKEN" \
  -d '{"title":"Título atualizado","images":["stories/novo1.jpg","stories/novo2.jpg"]}'
```
- Resposta (200): `{ "story": { ... } }`

5) Deletar Story
- Método: DELETE
- URL: `/stories/{id}`
- Exemplo curl:
```bash
curl -X DELETE "https://seu-dominio.test/api/admin/stories/10" -H "X-Admin-Token: SEU_TOKEN"
```
- Resposta (200):
```json
{ "deleted": true }
```

Códigos de erro comuns
- 401: `{ "error": "unauthorized" }` — token inválido ou sessão não autenticada.
- 404: `{ "error": "not_found" }` — recurso não existe.
- 422: validação de payload (padrão do Laravel quando `validate()` falha).

Exemplos de integração

JavaScript (fetch):
```js
fetch('https://seu-dominio.test/api/admin/stories', {
  headers: {
    'Content-Type': 'application/json',
    'X-Admin-Token': 'SEU_TOKEN'
  }
}).then(r => r.json()).then(console.log);
```

PHP (Guzzle):
```php
$client = new \GuzzleHttp\Client(['base_uri' => 'https://seu-dominio.test']);
$res = $client->request('POST', '/api/admin/stories', [
  'headers' => ['X-Admin-Token' => 'SEU_TOKEN'],
  'json' => [
    'title' => 'Teste via Guzzle',
    'images' => ['stories/exemplo.jpg']
  ]
]);
echo $res->getStatusCode();
echo $res->getBody();
```

Upload de arquivos de imagem
- A API atual não faz upload de arquivos — ela recebe paths/URLs no campo `images`.
- Para subir arquivos ao servidor, use o painel do Filament (`/admin/stories`) ou um endpoint dedicado de upload (não implementado). Após upload via painel os arquivos ficam em `storage/app/public/stories`.

Boas práticas e recomendações
- Use `X-Admin-Token` apenas em servidores confiáveis; se possível, integre via sessão (SSO) com o painel.
- Normalize as URLs das imagens no cliente (adicionar `https://seu-dominio.test/storage/` quando necessário).
- Se quiser suporte a `cover` via API, eu posso adicionar a validação e persistência do campo `cover` no `StoryApiController`.

Arquivo `.env` sugerido para token externo:
```
EXTERNAL_ADMIN_TOKEN=uma_chave_long_randomica
```

Precisa que eu:
- gere uma versão em inglês; ou
- adicione suporte a `cover` na API; ou
- crie um endpoint de upload para enviar imagens diretamente via API?

