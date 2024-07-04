# Используем официальный образ .NET
FROM mcr.microsoft.com/dotnet/aspnet:7.0 AS base
WORKDIR /app
EXPOSE 80

# Используем SDK для сборки проекта
FROM mcr.microsoft.com/dotnet/sdk:7.0 AS build
WORKDIR /src
COPY ["ApiForPhoto.csproj", "./"]
RUN dotnet restore "./ApiForPhoto.csproj"
COPY . .
WORKDIR "/src/."
RUN dotnet build "ApiForPhoto.csproj" -c Release -o /app/build

FROM build AS publish
RUN dotnet publish "ApiForPhoto.csproj" -c Release -o /app/publish

FROM base AS final
WORKDIR /app
COPY --from=publish /app/publish .
ENTRYPOINT ["dotnet", "ApiForPhoto.dll"]
